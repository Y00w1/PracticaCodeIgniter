<?php
namespace App\Controllers;
use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);
        $data = [
            'news' => $model->getNews(),
            'title' => 'News archive',
            'user' => session()->get('isLoggedIn') ? session()->get('user') : null,
            ];
        return view('templates/layout')
            . view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }

    public function view($slug = null)
    {
        $model = model(NewsModel::class);
        $data = ['news'=>$model->getNews($slug),
            'user' => session()->get('isLoggedIn') ? session()->get('user') : null,
        ];

        if (empty($data['news'])){
            throw new PageNotFoundException('Couldn\'t find the news you requested ' .$slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/layout')
            .view('templates/header', $data)
            .view('news/view')
            .view('templates/footer');
    }

    public function create()
    {
        helper('form');

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/layout')
                . view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['title', 'body']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'title' => 'required',
            'body'  => 'required',
        ])) {
            // The validation fails, so returns the form.
            return view('templates/layout')
                . view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }

        $model = model(NewsModel::class);

        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);

        return view('templates/layout')
            . view('templates/header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/footer');
    }
}