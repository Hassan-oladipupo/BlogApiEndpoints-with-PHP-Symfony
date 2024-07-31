<?php

namespace App\Service;

use App\Entity\BlogPost;

class BlogPostFormatter
{
    public function formatBlogPost(BlogPost $blogPost): array
    {
        return [
            'id' => $blogPost->getId(),
            'BlogTitle' => $blogPost->getBlogTitle(),
            'BlogText' => $blogPost->getBlogText(),
            'createdate' => $blogPost->getCreatedate()->format('Y-m-d'),
            'author' => $this->formatAuthor($blogPost->getAuthor()),
            'comments' => $this->formatComments($blogPost->getComments()->toArray()),
            'likedBy' => $this->formatUsers($blogPost->getLikedBy()->toArray()),
            'blogImage' => $blogPost->getBlogImage(),
        ];
    }

    public function formatBlogPosts(array $blogPosts): array
    {
        return array_map([$this, 'formatBlogPost'], $blogPosts);
    }

    private function formatAuthor($author): array
    {
        return [
            'id' => $author->getId(),
            'authorName' => $author->getUserProfile()->getName(),
            'profileImage' => $author->getUserProfile() ? $author->getUserProfile()->getImage() : null,
        ];
    }


    private function formatComments(array $comments): array
    {
        return array_map(function ($comment) {
            return [
                'id' => $comment->getId(),
                'commentText' => $comment->getText(),
                'createdate' => $comment->getCreatedate()->format('Y-m-d'),
                'author' => $this->formatAuthor($comment->getAuthor()),
            ];
        }, $comments);
    }

    private function formatUsers(array $users): array
    {
        return array_map(function ($user) {
            return $this->formatAuthor($user);
        }, $users);
    }
}
