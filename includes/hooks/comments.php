<?php

namespace jackwhitworth\hooks;


/**
 * Removes the website field from the comment form
 */
function removeCommentWebsiteField(array $fields): array
{
    if (isset($fields['url'])) {
        unset($fields['url']);
    }
    return $fields;
}
\add_filter('comment_form_default_fields', '\jackwhitworth\hooks\removeCommentWebsiteField');


/**
 * Reorders the comment form field to be the second-to-last element
 */
function reorderCommentFields(array $fields): array
{
    if (!isset($fields['comment'])) {
        return $fields;
    }
    
    $commentElement = ['comment' => $fields['comment']];
    unset($fields['comment']);
    
    return arrayInsertBeforeKey($fields, 'cookies', $commentElement);
}
\add_filter('comment_form_fields', '\jackwhitworth\hooks\reorderCommentFields');


/**
 * Reorders the comment form field to be the second-to-last element
 */
function changeCookieFieldText(array $fields): array
{
    if (!isset($fields['cookies'])) {
        return $fields;
    }
    
    $defaultText = 'Save my name, email, and website in this browser for the next time I comment.';
    if (str_contains($fields['cookies'], $defaultText)) {
        $fields['cookies'] = str_replace(
            $defaultText,
            'Save my name and email in this browser for the next time I comment.',
            $fields['cookies']
        );
    }
    
    return $fields;
}
\add_filter('comment_form_fields', '\jackwhitworth\hooks\changeCookieFieldText');
