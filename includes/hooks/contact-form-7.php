<?php

namespace jackwhitworth\hooks;

if (!defined('\jackwhitworth\hooks\dequeueContactForm7Scripts')) {
    /**
     * Dequeues CF7 scripts unless page is the contact page, set by ID
     */
    function dequeueContactForm7Scripts(): void
    {
            \wp_dequeue_script( 'contact-form-7' );
            \wp_dequeue_style( 'contact-form-7' );
    }
    \add_action( 'wp_enqueue_scripts', '\jackwhitworth\hooks\dequeueContactForm7Scripts', 999);
}
