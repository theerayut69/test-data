<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;

class ApiDataController extends Controller
{
    public function __construct()
    {
        $hosts = [ env('ELASTICSEARCH_HOST', 'http://laravel:laravel@elasticsearch:9200') ];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
        $this->index = 'mthai';
        $this->type = 'search';
    }
    public function get(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
            'section' => 'required'
        ]);
        $number_id = $request->input('id');
        $section = $request->input('section');
        $id = $section.':'.$number_id;
        $content = [
            'id' => $id,
            'index' => $this->index,
            'type' => $this->type
        ];
        try {
            $response = $this->client->get($content);
        } catch (\Exception $e) {
            $check_response = $e->getMessage();
            if (array_get($check_response, 'found') == false) {
                $response = response()->json([
                    'status' => '204',
                    'message' => 'Data not found'
                ]);
            }
        }
        return $response;
    }
    public function checkId($id)
    {
        $response = [];
        $content = [
            'id' => $id,
            'index' => $this->index,
            'type' => $this->type
        ];
        try {
            $response = $this->client->get($content);
        } catch (\Exception $e) {
            $check_response = $e->getMessage();
            if (array_get($check_response, 'found') == false) {
                $response = array('found' => false);
            }
        }
        return $response;
    }
    public function insert(Request $request)
    {
        $this->validate($request, [
            'section' => 'required',
            'id' => 'required|numeric',
            'title' => 'required',
            'permalink' => 'url',
            'bigthumb' => 'url',
            'thumb' => 'url',
            'created' => 'date|date_format:"Y-m-d H:i:s"',
            'modified' => 'date|date_format:"Y-m-d H:i:s"'
        ]);
        $number_id = $request->input('id');
        $section = $request->input('section');
        $id = $section.':'.$number_id;
        $checkId = $this->checkId($id);
        
        if ($checkId['found'] == false) {
            $con = [
                'post_id' => $request->input('id'),
                'section' => $request->input('section'),
                'title' => $request->input('title'),
                'excerpt' => $request->input('excerpt'),
                'content_plain' => $request->input('content_plain'),
                'content_html' => $request->input('content_html'),
                'permalink' => $request->input('permalink'),
                'author' => $request->input('author'),
                'bigthumb' => $request->input('bigthumb'),
                'thumb' => $request->input('thumb'),
                'post_type' => $request->input('post_type'),
                'created' => $request->input('created'),
                'modified' => $request->input('modified'),
                'allcontent' => $request->input('title').$request->input('content_plain')
            ];

            $category = $request->input('categories');
            $categories = explode(",", $category);
            foreach ($categories as $key => $category) {
                $con['categories'][$key]  = $category;
            }

            $tag = $request->input('tags');
            $tags = explode(",", $tag);
            foreach ($tags as $key => $tag) {
                $con['tags'][$key]  = $tag;
                $con['allcontent'] .= $tag;
            }
            $content = [
                'id' => $con['section'].':'.$con['post_id'],
                'index' => $this->index,
                'type' => $this->type,
                'body' => $con
            ];

            try {
                $check_response = $this->client->index($content);
                if ($check_response['created'] == true) {
                    $response = response()->json([
                        'status' => '200',
                        'message' => 'Insert data successful'
                    ]);
                }
            } catch (\Exception $e) {
                $response = response()->json([
                    'status' => '404',
                    'message' => 'Insert data failed'
                ]);
            }
        } else {
            $response = response()->json([
                'status' => '304',
                'message' => 'Insert data redundancy'
            ]);
        }
        return $response;
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
            'section' => 'required',
            'permalink' => 'url',
            'bigthumb' => 'url',
            'thumb' => 'url',
            'created' => 'date|date_format:"Y-m-d H:i:s"',
            'modified' => 'date|date_format:"Y-m-d H:i:s"'
        ]);
        $number_id = $request->input('id');
        $section = $request->input('section');
        $id = $section.':'.$number_id;
        $checkId = $this->checkId($id);
        if ($checkId['found'] == true) {
            $data = $checkId['_source'];
            $con = [
                'post_id' => $number_id,
                'section' => $section,
                'title' => ($request->has('title') ? $request->input('title') : $data['title']),
                'excerpt' => ($request->has('excerpt') ? $request->input('excerpt') : $data['excerpt']),
                'content_plain' => ($request->has('content_plain') ? $request->input('content_plain') : $data['content_plain']),
                'content_html' => ($request->has('content_html') ? $request->input('content_html') : $data['content_html']),
                'permalink' => ($request->has('permalink') ? $request->input('permalink') : $data['permalink']),
                'author' => ($request->has('author') ? $request->input('author') : $data['author']),
                'bigthumb' => ($request->has('bigthumb') ? $request->input('bigthumb') : $data['bigthumb']),
                'thumb' => ($request->has('thumb') ? $request->input('thumb') : $data['thumb']),
                'post_type' => ($request->has('post_type') ? $request->input('post_type') : $data['post_type']),
                'created' => ($request->has('created') ? $request->input('created') : $data['created']),
                'modified' => ($request->has('modified') ? $request->input('modified') : $data['modified'])
            ];
            $con['allcontent'] = $con['title'].$con['content_plain'];

            $category = $request->has('categories') ? $request->input('categories') : implode(",", $data['categories']);
            $categories = explode(",", $category);
            foreach ($categories as $key => $category) {
                $con['categories'][$key]  = $category;
            }


            $tag = $request->has('tags') ? $request->input('tags') : implode(",", $data['tags']);
            $tags = explode(",", $tag);
            foreach ($tags as $key => $tag) {
                $con['tags'][$key]  = $tag;
                $con['allcontent'] .= $tag;
            }
            $content = [
                'id' => $con['section'].':'.$con['post_id'],
                'index' => $this->index,
                'type' => $this->type,
                'body' => [
                    'doc' => $con
                ]
            ];

            try {
                $check_response = $this->client->update($content);
                if ($check_response["result"] == "updated") {
                    $response = response()->json([
                        'status' => '200',
                        'message' => 'Update data successful'
                    ]);
                } else {
                    $response = response()->json([
                        'status' => '304',
                        'message' => 'Update data redundancy'
                    ]);
                }
            } catch (\Exception $e) {
                $response = response()->json([
                    'status' => '404',
                    'message' => 'Update data failed'
                ]);
            }
        } else {
            $response = response()->json([
                'status' => '204',
                'message' => 'Data not found'
            ]);
        }
        return $response;
    }
    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
            'section' => 'required'
        ]);
        $number_id = $request->input('id');
        $section = $request->input('section');
        $id = $section.':'.$number_id;
        $checkId = $this->checkId($id);

        if ($checkId["found"] == true) {
            $content = [
                'id' => $id,
                'index' => $this->index,
                'type' => $this->type
            ];
            try {
                $check_response = $this->client->delete($content);
                if ($check_response['found'] == true) {
                    $response = response()->json([
                        'status' => '200',
                        'message' => 'Delete data successful'
                    ]);
                }
            } catch (\Exception $e) {
                $check_response = $e->getMessage();
                if ($check_response['found'] == false) {
                    $response = response()->json([
                        'status' => '404',
                        'message' => 'Delete data failed'
                    ]);
                }
            }
        } else {
            $response = response()->json([
                'status' => '204',
                'message' => 'Data not found'
            ]);
        }
        return $response;
    }
    public function section(Request $request)
    {
        $this->validate($request, [
            'offset' => 'numeric',
            'size' => 'numeric'
        ]);
        $offset = 0;
        $size = 16;
        if ($request->has('offset')) {
            $offset = $request->input('offset');
        }
        if ($request->has('size')) {
            $size = $request->input('size');
        }
        $section = $request->section;
        if ($section) {
            $fields = array('section');
            $parameters = [
                'size' => $size,
                'from' => $offset,
                'body' => [
                    'query' => [
                        'more_like_this' => [
                            'fields' => $fields ,
                            'like' => $section ,
                            'min_term_freq' => 1 ,
                            'max_query_terms' => 25 ,
                            'min_doc_freq' => 1
                        ]
                    ]
                ]
            ];
            $check_response = $this->client->search($parameters);
            $total = json_encode($check_response['hits']['total']);
            if ($total == 0) {
                $response = response()->json([
                    'status' => '204',
                    'message' => 'Data not found'
                ]);
            } else {
                $response = $check_response;
            }
        }
        return $response;
    }
    public function searchAll(Request $request)
    {
        $this->validate($request, [
            'offset' => 'numeric',
            'size' => 'numeric',
            'keyword' => 'required'
        ]);
        $offset = 0;
        $size = 16;
        if ($request->has('offset')) {
            $offset = $request->input('offset');
        }
        if ($request->has('size')) {
            $size = $request->input('size');
        }
        $keyword = $request->keyword;
        
        $fields = array('title','detail','tags');
        $parameters = [
            'size' => $size,
            'from' => $offset,
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $keyword ,
                        'fields' => $fields
                    ]
                ],
                'sort' =>[
                    '_score' => [
                        'order' => 'desc'
                    ]
                ]
            ]
        ];
        $check_response = $this->client->search($parameters);
        $total = json_encode($check_response['hits']['total']);
        if ($total == 0) {
            $response = response()->json([
                'status' => '204',
                'message' => 'Search data not found'
            ]);
        } else {
            $response = $check_response;
        }
        return $response;
    }
    public function searchBySection(Request $request)
    {
        $this->validate($request, [
            'offset' => 'numeric',
            'size' => 'numeric',
            'keyword' => 'required'
        ]);
        $offset = 0;
        $size = 16;
        if ($request->has('offset')) {
            $offset = $request->input('offset');
        }
        if ($request->has('size')) {
            $size = $request->input('size');
        }
        $section = $request->section;
        $keyword = $request->input('keyword');
        $parameters = [
            'size' => $size,
            'from' => $offset,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'match' => [
                                    'section' => $section
                                ]
                            ],
                            [
                                'match' => [
                                    'allcontent' => $keyword
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $check_response = $this->client->search($parameters);
        $total = json_encode($check_response['hits']['total']);
        if ($total == 0) {
            $response = response()->json([
                'status' => '204',
                'message' => 'Search data not found'
            ]);
        } else {
            $response = $check_response;
        }
        return $response;
    }
    public function searchRelatedAll(Request $request)
    {
        $this->validate($request, [
            'offset' => 'numeric',
            'size' => 'numeric',
            'id' => 'required|numeric',
            'section' => 'required'
        ]);
        $offset = 0;
        $size = 16;
        if ($request->has('offset')) {
            $offset = $request->input('offset');
        }
        if ($request->has('size')) {
            $size = $request->input('size');
        }
        $number_id = $request->input('id');
        $section = $request->input('section');
        $id = $section.':'.$number_id;

        $fields = array('allcontent');
        $parameters = [
            'size' => $size,
            'from' => $offset,
            'body' => [
                'query' => [
                    'more_like_this' => [
                        'fields' => $fields ,
                        'like' => [
                            '_index' => $this->index,
                            '_type' => $this->type,
                            '_id' => $id
                        ],
                        'min_term_freq' => 1 ,
                        'max_query_terms' => 25 ,
                        'min_doc_freq' => 1
                    ]
                ]
            ]
        ];
        $check_response = $this->client->search($parameters);
        $total = json_encode($check_response['hits']['total']);
        if ($total == 0) {
            $response = response()->json([
                'status' => '204',
                'message' => 'Data not found'
            ]);
        } else {
            $response = $check_response;
        }
        
        return $response;
    }
    public function searchRelatedBySection(Request $request)
    {
        $this->validate($request, [
            'offset' => 'numeric',
            'size' => 'numeric',
            'id' => 'required|numeric',
            'section' => 'required'
        ]);
        $offset = 0;
        $size = 16;
        if ($request->has('offset')) {
            $offset = $request->input('offset');
        }
        if ($request->has('size')) {
            $size = $request->input('size');
        }
        $number_id = $request->input('id');
        $section = $request->input('section');
        $id = $section.':'.$number_id;

        $field_sec = array('section');
        $fields = array('allcontent');
        $parameters = [
            'size' => $size,
            'from' => $offset,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'more_like_this' => [
                                    'fields' => $field_sec ,
                                    'like' => $section ,
                                    'min_term_freq' => 1 ,
                                    'max_query_terms' => 25 ,
                                    'min_doc_freq' => 1
                                ]
                            ],
                            [
                                'more_like_this' => [
                                    'fields' => $fields ,
                                    'like' => [
                                        '_index' => $this->index,
                                        '_type' => $this->type,
                                        '_id' => $id
                                    ],
                                    'min_term_freq' => 1 ,
                                    'max_query_terms' => 25 ,
                                    'min_doc_freq' => 1
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $check_response = $this->client->search($parameters);
        $total = json_encode($check_response['hits']['total']);
        if ($total == 0) {
            $response = response()->json([
                'status' => '204',
                'message' => 'Data not found'
            ]);
        } else {
            $response = $check_response;
        }
        return $response;
    }
    public function feedContent(Request $request)
    {
        $this->validate($request, [
            'start' => 'numeric',
            'total' => 'numeric'
        ]);
        $start = 0;
        $total = 16;
        if ($request->has('start')) {
            $start = $request->input('start');
        }
        if ($request->has('total')) {
            $total = $request->input('total');
        }
        $section = $request->input('section');
        $url_feed = "https://video.mthai.com/2016/feed/feed-video-elastic.php?start=".$start."&total=".$total;
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url_feed,
        ));
        $resp = curl_exec($curl);
        curl_close($curl);
        $contents = json_decode($resp);

        foreach ($contents as $key => $item) {
            $item_content = [
                'post_id' => $section.':'.$item->id,
                'section' => $section,
                'title' => $item->title,
                'excerpt' => $item->title,
                'content_plain' => strip_tags($item->description),
                'content_html' => $item->description,
                'permalink' => "https://women.mthai.com/snap-signature/306083.html?utm_source=home-mthai&utm_campaign=home-highlight-hots&utm_medium=hot-8",
                'categories' => "star",
                'author' => "snapsignature",
                'bigthumb' => "https://women.mthai.com/app/uploads/2017/07/8-6.jpg",
                'thumb' => "https://women.mthai.com/app/uploads/2017/07/11.png",
                'modified' => $item->upload_time,
                'post_type' => $section,
                'created' => $item->upload_time,
                'allcontent' => $item->title.strip_tags($item->description)
            ];

            if ($item->tags_status != 0) {
                foreach ($item->tags as $key => $tags) {
                    $item_content['tags'][$key] = $tags;
                    $item_content['allcontent'] .= $tags;
                }
            }
            $row = [
                'id' => $item_content['post_id'],
                'index' => $this->index,
                'type' => $this->type,
                'body' => $item_content
            ];
            $response = $this->client->index($row);
        }
        return $response;
    }
}
