<?php
/**
 * Goliath block patterns — page template starters.
 *
 * These appear in the block inserter under "Goliath — Page Templates".
 * The client can insert them with one click when creating a new page,
 * then fill in the text and images to suit.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Register all Goliath page-template block patterns.
 */
function my_theme_register_block_patterns(): void
{
    // Register the pattern category.
    register_block_pattern_category(
        'goliath-page-templates',
        ['label' => __('Goliath — Page Templates', 'my-custom-theme')]
    );

    /* ------------------------------------------------------------------ */
    /*  1. New Service Page                                                 */
    /* ------------------------------------------------------------------ */
    register_block_pattern(
        'goliath/new-service-page',
        [
            'title'       => __('New Service Page', 'my-custom-theme'),
            'description' => __('Full service page: hero, orange banner statement, benefit tick-list, three content cards, image-text split, and CTA.', 'my-custom-theme'),
            'categories'  => ['goliath-page-templates'],
            'content'     => '<!-- wp:goliath/hero-section {"heading":"Service Name","subheading":"A short, compelling one-line description of the service and who it benefits.","primaryButtonText":"Book Free Assessment","primaryButtonUrl":"/contact/"} /-->

<!-- wp:goliath/orange-banner {"text":"SEMA-qualified technicians. 30-minute installation. Lifetime warranty on every repair.","background":"orange","centered":true,"size":"medium"} /-->

<!-- wp:goliath/tick-list {"heading":"What\'s Included","items":[{"text":"Free site survey and damage assessment"},{"text":"SEMA-qualified engineers on every job"},{"text":"30-minute installation per upright"},{"text":"Zero operational downtime required"},{"text":"Lifetime warranty on all repairs"},{"text":"Full compliance documentation provided"}],"columns":"2","theme":"light","background":"gray"} /-->

<!-- wp:goliath/content-card {"heading":"Card Title One","body":"Describe this aspect of the service clearly and concisely. Focus on the client benefit.","theme":"dark"} /-->

<!-- wp:goliath/content-card {"heading":"Card Title Two","body":"Describe this aspect of the service clearly and concisely. Focus on the client benefit.","theme":"dark"} /-->

<!-- wp:goliath/content-card {"heading":"Card Title Three","body":"Describe this aspect of the service clearly and concisely. Focus on the client benefit.","theme":"dark"} /-->

<!-- wp:goliath/image-text-split {"heading":"Why This Service Matters","body":"Explain the importance of the service, the risks of not acting, and the benefits of choosing Goliath. Use clear, professional language.","callout":"Safety-critical work carried out by SEMA-qualified engineers.","imagePosition":"left","background":"white"} /-->

<!-- wp:goliath/callout-box {"text":"Ready to book your free assessment? Our team responds within one working day.","theme":"orange","showArrow":true,"layout":"full-width"} /-->

<!-- wp:goliath/cta-section {"heading":"Book Your Free Assessment","body":"Our SEMA-qualified engineers will assess your warehouse, identify risk areas, and provide transparent pricing with no obligation.","primaryButtonText":"Get a Free Quote","primaryButtonUrl":"/contact/","theme":"dark"} /-->',
        ]
    );

    /* ------------------------------------------------------------------ */
    /*  2. New Content / Landing Page                                       */
    /* ------------------------------------------------------------------ */
    register_block_pattern(
        'goliath/new-content-page',
        [
            'title'       => __('New Content Page', 'my-custom-theme'),
            'description' => __('General content page: hero, two-column text section, two content cards, and CTA.', 'my-custom-theme'),
            'categories'  => ['goliath-page-templates'],
            'content'     => '<!-- wp:goliath/hero-section {"heading":"Page Title","subheading":"A short introduction to this page and what visitors will find here.","primaryButtonText":"Get in Touch","primaryButtonUrl":"/contact/"} /-->

<!-- wp:goliath/text-columns {"heading":"Section Heading","leftColumn":"Write the left column content here. Keep paragraphs short and scannable. Focus on the key message you want the visitor to take away.","rightColumn":"Write the right column content here. You can use this column to expand on a point, add supporting detail, or introduce a second topic."} /-->

<!-- wp:goliath/content-card {"heading":"Key Point One","body":"Explain this key point in 2–3 sentences. Keep it clear and client-focused.","theme":"dark"} /-->

<!-- wp:goliath/content-card {"heading":"Key Point Two","body":"Explain this key point in 2–3 sentences. Keep it clear and client-focused.","theme":"dark"} /-->

<!-- wp:goliath/cta-section {"heading":"Ready to Find Out More?","body":"Get in touch with our team today for honest advice and transparent pricing.","primaryButtonText":"Contact Us","primaryButtonUrl":"/contact/","theme":"dark"} /-->',
        ]
    );

    /* ------------------------------------------------------------------ */
    /*  3. New FAQ Page                                                     */
    /* ------------------------------------------------------------------ */
    register_block_pattern(
        'goliath/new-faq-page',
        [
            'title'       => __('New FAQ Page', 'my-custom-theme'),
            'description' => __('FAQ page with hero, accordion, resource links, and CTA.', 'my-custom-theme'),
            'categories'  => ['goliath-page-templates'],
            'content'     => '<!-- wp:goliath/hero-section {"heading":"Frequently Asked Questions","subheading":"Everything you need to know about warehouse racking repair, safety, and compliance.","primaryButtonText":"Book Free Assessment","primaryButtonUrl":"/contact/"} /-->

<!-- wp:goliath/faq-accordion {"heading":"Common Questions","showHeading":true,"items":[{"question":"How long does installation take?","answer":"Most installations are completed within 30 minutes per upright with no operational downtime required."},{"question":"Is there a warranty on repairs?","answer":"Yes. Every repair carried out by Goliath comes with a lifetime warranty."},{"question":"Are your engineers SEMA qualified?","answer":"Yes. All of our engineers hold SEMA qualifications and carry full certification documentation."},{"question":"How quickly can you respond?","answer":"We aim to respond to all enquiries within one working day and can arrange emergency assessments within 48 hours."}]} /-->

<!-- wp:goliath/resource-cards {"heading":"Explore Further","card1Title":"How It Works","card1Desc":"See the full step-by-step process from assessment to sign-off.","card1ButtonText":"Learn More","card1Url":"/how-it-works/","card2Title":"Our Services","card2Desc":"Browse the full range of warehouse racking repair and installation services.","card2ButtonText":"View Services","card2Url":"/services/","card3Title":"Case Studies","card3Desc":"See real results from clients across the UK.","card3ButtonText":"Read Case Studies","card3Url":"/case-studies/"} /-->

<!-- wp:goliath/cta-section {"heading":"Still Have Questions?","body":"Our team is happy to help. Get in touch and we\'ll respond within one working day.","primaryButtonText":"Contact Us","primaryButtonUrl":"/contact/","theme":"dark"} /-->',
        ]
    );

    /* ------------------------------------------------------------------ */
    /*  4. New Team / About Page                                            */
    /* ------------------------------------------------------------------ */
    register_block_pattern(
        'goliath/new-team-page',
        [
            'title'       => __('New Team / About Page', 'my-custom-theme'),
            'description' => __('About or team page with hero, intro text, team member cards, and CTA.', 'my-custom-theme'),
            'categories'  => ['goliath-page-templates'],
            'content'     => '<!-- wp:goliath/hero-section {"heading":"Meet the Team","subheading":"The SEMA-qualified engineers and operations team behind every Goliath repair.","primaryButtonText":"Book Free Assessment","primaryButtonUrl":"/contact/"} /-->

<!-- wp:goliath/text-columns {"heading":"Who We Are","leftColumn":"Goliath Racking Repair is a specialist warehouse racking repair company serving clients across the UK and Europe. Founded by engineers with decades of experience in the industry, the business was built on a simple principle: safety-critical work should be done properly, every time.","rightColumn":"Every member of our team holds SEMA qualifications. We carry full compliance documentation on every job, and we stand behind our work with a lifetime warranty on every repair."} /-->

<!-- wp:goliath/team-member {"name":"Team Member Name","role":"Job Title","qualifications":"SEMA Qualified","bio":"Write a short biography here. Include their experience, qualifications, and what they bring to the team.","background":"white"} /-->

<!-- wp:goliath/team-member {"name":"Team Member Name","role":"Job Title","qualifications":"SEMA Qualified","bio":"Write a short biography here. Include their experience, qualifications, and what they bring to the team.","background":"white"} /-->

<!-- wp:goliath/cta-section {"heading":"Work With Our Team","body":"Book a free site assessment and meet the engineers who will be on site.","primaryButtonText":"Book Free Assessment","primaryButtonUrl":"/contact/","theme":"dark"} /-->',
        ]
    );

    /* ------------------------------------------------------------------ */
    /*  5. New Legal Page                                                   */
    /* ------------------------------------------------------------------ */
    register_block_pattern(
        'goliath/new-legal-page',
        [
            'title'       => __('New Legal Page', 'my-custom-theme'),
            'description' => __('Legal document page with branded hero and structured prose sections. Use for Privacy Policy, Terms of Service, and similar documents.', 'my-custom-theme'),
            'categories'  => ['goliath-page-templates'],
            'content'     => '<!-- wp:goliath/hero-section {"heading":"Privacy Policy","subheading":"This policy explains how Goliath Racking Repair collects, uses, and protects your personal information.","showPrimaryButton":false} /-->

<!-- wp:goliath/legal-document {"introText":"This Privacy Policy describes how Goliath Racking Repair (\"we\", \"us\", or \"our\") collects, uses, and shares information about you when you use our website or contact us for services.\n\nLast updated: January 2025","section1Heading":"1. Information We Collect","section1Body":"We collect information you provide directly to us, such as your name, company name, email address, and phone number when you fill in our contact form or book an assessment.\n\nWe also collect certain technical information automatically when you visit our website, including your IP address, browser type, and pages visited.","section2Heading":"2. How We Use Your Information","section2Body":"We use the information we collect to respond to your enquiries, arrange site assessments, provide quotes, and send service-related communications.\n\nWe do not sell your personal data to third parties.","section3Heading":"3. Your Rights","section3Body":"You have the right to request access to the personal data we hold about you, to have it corrected or deleted, and to withdraw consent for marketing communications at any time.\n\nTo exercise any of these rights, please contact us at the details below.","section4Heading":"4. Contact","section4Body":"For any questions about this policy or your personal data, please contact us by email or phone as listed on our Contact page."} /-->',
        ]
    );
}
add_action('init', 'my_theme_register_block_patterns');
