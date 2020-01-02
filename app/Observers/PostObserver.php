<?php

namespace App\Observers;

use App\Post;
use App\Language;
use Illuminate\Http\Request;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        // dd($request->all());

        $postFillable = $this->getPostFillable();
        $postLanguageFillable = $this->getFilterData($postFillable);
        $languages = Language::all();
        $this->saveDataPostLanguage($post, $postLanguageFillable, $languages, $status = 'created');
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        if(request('type') != 'trash' && request('type') != 'restore') {
            $postFillable = $this->getPostFillable();
            $postLanguageFillable = $this->getFilterData($postFillable);
            $languages = Language::all();
            $this->saveDataPostLanguage($post, $postLanguageFillable, $languages, $status = 'updated');
        }
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    public function deleting(Post $post) {
        // $post = Post::find(request('id'));
        $result = $this->checkPostWereTrashed($post->id);
        if($result == true) {
            $result = $post->languages()->detach();
        }
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }

    private function getPostFillable() {
        return config('fillable.post');
    }

    private function getFilterData($postFillable) {
        array_push($postFillable, '_token', '_method');
        return request()->except($postFillable);
    }

    private function saveDataPostLanguage($post, $postLanguageFillable, $languages, $status) {
        foreach($languages as $lang) {
            $language = Language::find($lang->id);
            $data = [
                'title' => request("title-" . $lang->code),
                'content' => request("content-" . $lang->code),
            ];
            if ($status == 'created') {
                $post->languages()->attach($language, $data);
            } elseif ($status == 'updated') {
                $post->languages()->updateExistingPivot($language, $data);
            }
        }
    }

    private function checkPostWereTrashed($id) {
        $post = Post::where([['deleted_at', '<>', null], ['id', '=', $id]])->count();
        if($post > 0) {
            return true;
        }
        return false;
    }

    // private function updateDataPostLanguage($post, $postLanguageFillable, $languages) {
    //     foreach ($languages as $lang) {
    //         $language = Language::find($lang->id);
    //         $data = [
    //             'title' => $request->input('title-' . $lang->code),
    //             'content' => $request->input('content-' . $lang->code),
    //         ];
    //         $post->languages()->updateExistingPivot($language, $data);
    //     }
    // }
}
