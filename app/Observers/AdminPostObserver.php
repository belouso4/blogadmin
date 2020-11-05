<?php

namespace App\Observers;

use App\Models\Admin\Post;
use Carbon\Carbon;

class AdminPostObserver
{
    public function creating(Post $post)
    {
        $this->getAlias($post);
    }
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        //
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
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

    public function getAlias(Post $post)
    {
        if (empty($post->alias)) {
            $post->alias = \Str::slug($post->title);
            $check = Post::where('alias', '=', $post->alias)->exists();
            if ($check) {
                $post->alias = \Str::slug($post->title) . time();
            }
        }
    }

    public function saving(Post $post)
    {

        $this->setPublishedAt($post);
    }

    public function setPublishedAt(Post $post)
    {
        $needSetPublished = empty($post->apdated_at) || !empty($post->apdated_at);

        if ($needSetPublished) {

            $post->updated_at = Carbon::now();
        }
    }
}
