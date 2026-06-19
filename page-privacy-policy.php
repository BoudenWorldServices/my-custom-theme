<?php
/*
Template Name: Privacy Policy Page
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
                    <span class="text-white">Privacy </span><span class="text-[#ff5c00]">Policy</span>
                </h1>
                <p class="max-w-[1100px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    How Goliath Pallet Racking Repair Ltd collects, uses, and protects your information.
                </p>
            </div>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <div class="max-w-[1100px] space-y-8">
                <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                    Goliath Pallet Racking Repair Ltd is the sole owner of the information collected on www.goliathrepair.co.uk. Goliath Pallet Racking Repair Ltd collects information from our users at several different points on our website.
                </p>
                <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                    Other than for specific purposes as agreed with the user such as fulfilling an online order, the information that is collected through this site is used for marketing or analysis purposes only.
                </p>

                <div class="space-y-4">
                    <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Analysis</h2>
                    <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                        Information gathered through this website will be held in a database at our office and be used periodically to assess the success of the website and the actions required from the levels of traffic generated.
                    </p>
                    <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                        When you request a page from the site&apos;s web server, the server automatically collects some information about your system, including your IP address. Goliath Pallet Racking Repair Ltd collects the minimum information necessary to ensure our service works. We do not currently provide or share your information with other third parties.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Enquiry Form</h2>
                    <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                        We ask for information from the user on our enquiry form. Information gathered through this form will be held in a database at our offices and be used periodically to assist in the various marketing activities of Goliath Pallet Racking Repair Ltd.
                    </p>
                    <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                        We do not currently provide or share your information with other third parties.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Legal Disclaimer</h2>
                    <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                        Though we make every effort to preserve user privacy, we may need to disclose personal information when required by law wherein we have a good-faith belief that such action is necessary to comply with a current judicial proceeding, a court order or legal process served on our website.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Business Transitions</h2>
                    <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                        In the event Goliath Pallet Racking Repair Ltd goes through a business transition, such as a merger, being acquired by another company, or selling a portion of its assets, users&apos; personal information will, in most instances, be part of the assets transferred. If as a result of the business transition, the users&apos; personally identifiable information will be used in a manner different from that stated at the time of collection they will be given choice consistent with our notification of changes section.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Links</h2>
                    <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                        This website contains links to other sites. Please be aware that we, Goliath Pallet Racking Repair Ltd, are not responsible for the privacy practices of such other sites. This privacy statement applies solely to information collected by this website.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Changes to this Statement</h2>
                    <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                        Goliath Pallet Racking Repair Ltd will occasionally update this Privacy Statement to reflect company and customer feedback. Goliath Pallet Racking Repair Ltd encourages you to periodically review this Statement to be informed of how Goliath Pallet Racking Repair Ltd is protecting your information.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Unsubscribing</h2>
                    <p class="font-roboto text-[17px] leading-[28px] text-[#364153]">
                        We shall remove you from our database of site users and stop sending you information upon request.
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
