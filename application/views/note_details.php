<?php

$s3BaseUrl =
    'https://unistudio-product-files-wilson.s3.ap-southeast-2.amazonaws.com/';

$extension = strtolower(
    pathinfo(
        $note->filename,
        PATHINFO_EXTENSION
    )
);

$currentUser =
    $this->session->userdata('username');

?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/note_detail.css') ?>"
>


<div class="note-detail-page">

    <!-- LEFT: IMAGE / VIDEO -->
    <div class="note-media">

        <?php if (
            $extension === 'jpg' ||
            $extension === 'jpeg' ||
            $extension === 'png' ||
            $extension === 'webp'
        ): ?>

            <img
                src="<?= $s3BaseUrl . $note->filename ?>"
                alt="<?= html_escape($note->subject) ?>"
            >

        <?php elseif ($extension === 'mp4'): ?>

            <video controls>
                <source
                    src="<?= $s3BaseUrl . $note->filename ?>"
                    type="video/mp4"
                >
            </video>

        <?php endif; ?>

    </div>


    <!-- RIGHT: NOTE DETAILS -->
    <div class="note-content">

        <!-- USER -->
        <div class="note-user">

            <div class="note-user-info">

                <strong>
                    <?= html_escape($note->username) ?>
                </strong>

                <span>
                    <?= (int) $subscriber_count ?>
                    subscribers
                </span>

            </div>


            <?php if (
                $currentUser &&
                $currentUser !== $note->username
            ): ?>

                <button
                    type="button"
                    id="subscribeButton"
                    class="subscribe-button"
                    data-uploader="<?= html_escape(
                        $note->username
                    ) ?>"
                >
                    <?= $is_subscribed
                        ? 'Subscribed'
                        : 'Subscribe'
                    ?>
                </button>

            <?php endif; ?>

        </div>


        <!-- TITLE -->
        <h1 class="note-title">
            <?= html_escape($note->subject) ?>
        </h1>


        <!-- DESCRIPTION -->
        <div class="note-description">
            <?= nl2br(
                html_escape(
                    $note->description ?? ''
                )
            ) ?>
        </div>


        <!-- ACTIONS -->
        <div class="note-actions">

            <button type="button" class="note-action-button">
                ♡ <?= (int) $note->likes ?>
            </button>

            <span>
                👁 <?= (int) $note->views ?> views
            </span>

        </div>


        <hr>


        <!-- COMMENTS -->
        <div class="note-comments">

            <h4>
                Comments
            </h4>


            <?php if ($currentUser): ?>

                <form
                    method="post"
                    action="<?= base_url(
                        'comments/add/' .
                        $note->id
                    ) ?>"
                    class="comment-form"
                >

                    <input
                        type="hidden"
                        name="return_url"
                        value="<?= base_url(
                            'notes/view/' . $note->id
                        ) ?>"
                    >
                    <textarea
                        name="comment"
                        placeholder="Add a comment..."
                        required
                    ></textarea>

                    <button type="submit">
                        Comment
                    </button>

                </form>

            <?php else: ?>

                <p>
                    Please log in to comment.
                </p>

            <?php endif; ?>


            <div class="comment-list">

                <?php if (empty($comments)): ?>

                    <p class="no-comments">
                        No comments yet.
                    </p>

                <?php else: ?>

                    <?php foreach ($comments as $comment): ?>

                        <div class="comment">

                            <strong>
                                <?= html_escape(
                                    $comment->username
                                ) ?>
                            </strong>

                            <p>
                                <?= html_escape(
                                    $comment->content
                                ) ?>
                            </p>

                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>