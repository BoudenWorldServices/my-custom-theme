<?php
/*
Template Name: Terms of Service Page
*/
get_header();
// If this page has Gutenberg blocks, render the block editor content.
// Otherwise the existing template below is used unchanged.
$_current_page = get_queried_object();
if ($_current_page instanceof WP_Post && has_blocks($_current_page)) {
    setup_postdata($_current_page);
    echo "<main class=\"w-full bg-white overflow-x-hidden\">";
    the_content();
    echo "</main>";
    wp_reset_postdata();
    get_footer();
    return;
}
?>

<main class="w-full bg-white overflow-x-hidden">
    <section
        class="relative w-full h-auto lg:h-[320px] hero-gradient-bg"
    >
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-4 lg:h-[180px] lg:justify-between lg:gap-0">
                <h1 class="font-montserrat text-[28px] font-bold leading-[36px] text-white sm:text-[36px] sm:leading-[44px] lg:text-[56px] lg:leading-[64px]">
                    <span class="text-white">Terms and </span><span class="text-[#ff5c00]">Conditions</span>
                </h1>
                <p class="max-w-[1100px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    Terms governing your use of the Goliath Pallet Racking Repair Ltd website.
                </p>
            </div>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <div class="max-w-[1100px] space-y-8">
                <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                    If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our Privacy Policy and our Cookie Policy govern Goliath Pallet Racking Repair Ltd&apos;s relationship with you in relation to this website.
                </p>
                <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                    If you disagree with any part of these terms and conditions, please do not use our website.
                </p>
                <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                    The term Goliath Pallet Racking Repair Ltd or &lsquo;us&rsquo; or &lsquo;we&rsquo; refers to the owner of the website whose contact details can be found on our contact page. The term &lsquo;you&rsquo; refers to the user or viewer of our website.
                </p>

                <div class="space-y-4">
                    <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">The use of this website is subject to the following terms of use</h2>
                    <?php
                    $terms_points = [
                        'The content of the pages of this website is for your general information and use only. It is subject to change without notice.',
                        'This website uses cookies and may not function correctly without them. By using our website and agreeing to these terms and conditions you are consenting to our use of cookies in accordance with our cookie policy. Please refer to our cookie policy for further information.',
                        'Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.',
                        'Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.',
                        'This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.',
                        'All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.',
                        'From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).',
                        'Your use of this website and any dispute arising out of such use of the website is subject to the laws of England, Northern Ireland, Scotland and Wales.',
                        'Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.',
                    ];
                    ?>
                    <ul class="space-y-6">
                        <?php foreach ($terms_points as $point) : ?>
                            <li class="flex items-start gap-4">
                                <img
                                    src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/Icon-1.svg')); ?>"
                                    alt=""
                                    class="mt-[3px] h-6 w-6 shrink-0"
                                    width="24"
                                    height="24"
                                    aria-hidden="true"
                                >
                                <span class="font-roboto text-[17px] leading-[28px] text-[#364153]"><?php echo esc_html($point); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
