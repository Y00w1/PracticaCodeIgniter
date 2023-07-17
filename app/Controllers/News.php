<?php
namespace App\Controllers;
use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\I18n\Time;

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
        $data = [
            'title' => 'News archive',
            'user' => session()->get('isLoggedIn') ? session()->get('user') : null,
        ];

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/layout')
                . view('templates/header', $data)
                . view('news/create')
                . view('templates/footer');
        }

        $image = $this->request->getFile('image');
        $post = $this->request->getPost(['title', 'lead', 'body', 'closure']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'title' => 'required',
            'lead' => 'required',
            'body'  => 'required',
            'closure' => 'required',
            'image' => 'is_image[image]'
        ])) {
            // The validation fails, so returns the form.
            return view('templates/layout')
                . view('templates/header', $data)
                . view('news/create')
                . view('templates/footer');
        }

        $author = (int)$data['user']['id'];
        $model = model(NewsModel::class);

        if ($image->isValid() && !$image->hasMoved()) {
            // Define the directory where you want to save the uploaded file
            $directory = WRITEPATH . 'uploads/';

            // Generate a unique name for the file
            $newName = $image->getRandomName();

            // Move the file to the specified directory with the new name
            $image->move($directory, $newName);

            $model->save([
                'title' => $post['title'],
                'slug' => url_title($post['title'], '-', true),
                'lead' => $post['lead'],
                'body' => $post['body'],
                'closure' => $post['closure'],
                'image' => $directory . $newName,
                'author' => $author,
                'date' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $model->save([
                'title' => $post['title'],
                'slug' => url_title($post['title'], '-', true),
                'lead' => $post['lead'],
                'body' => $post['body'],
                'closure' => $post['closure'],
                'author' => $author,
                'date' => date('Y-m-d H:i:s'),
            ]);
        }

        return view('templates/layout')
            . view('templates/header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/footer');
    }
}