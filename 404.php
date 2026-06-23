<?php get_header(); ?>

<main class="w-full bg-white overflow-x-hidden">

    <!-- Hero -->
    <section class="relative w-full hero-gradient-bg">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-16 sm:px-6 lg:px-[68px] lg:py-[100px]">
            <div class="flex w-full flex-col items-center text-center gap-6">
                <p class="font-montserrat text-[96px] font-bold leading-none text-[#ff5c00] lg:text-[140px]" aria-hidden="true">
                    404
                </p>
                <h1 class="font-montserrat text-[32px] font-bold leading-[40px] text-white sm:text-[40px] lg:text-[48px] lg:leading-[56px]">
                    Page not found
                </h1>
                <p class="max-w-[560px] font-montserrat text-[17px] font-normal leading-[28px] text-white/80 lg:text-[19px] lg:leading-[30px]">
                    The page you're looking for doesn't exist or may have moved. Try one of the links below.
                </p>
                <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:justify-center">
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                       class="inline-flex h-[52px] items-center justify-center bg-[#ff5c00] px-8 font-montserrat text-[15px] font-semibold text-white transition-colors hover:bg-[#e55200]">
                        Back to homepage
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>"
                       class="inline-flex h-[52px] items-center justify-center border-2 border-white px-8 font-montserrat text-[15px] font-semibold text-white transition-colors hover:bg-white hover:text-[#020202]">
                        Contact us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular pages -->
    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-14 sm:px-6 lg:px-[68px] lg:py-[80px]">

            <div class="mb-10 text-center">
                <h2 class="font-montserrat text-[26px] font-bold leading-[34px] text-[#020202] lg:text-[32px] lg:leading-[42px]">
                    Where would you like to go?
                </h2>
                <p class="mt-3 font-montserrat text-[16px] font-normal leading-[26px] text-[#4b5563]">
                    Here are some of the most useful pages on our site.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                <!-- Why Goliath™? -->
                <a href="<?php echo esc_url(home_url('/why-goliath/')); ?>"
                   class="group flex flex-col gap-5 bg-white p-8 transition-shadow hover:shadow-md">
                    <div class="flex size-[52px] shrink-0 items-center justify-center bg-[#ff5c00]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 2L3 7v5c0 5.25 3.75 10.15 9 11.25C17.25 22.15 21 17.25 21 12V7L12 2z" fill="white"/>
                            <path d="M10 12.5l2.5 2.5 4-4" stroke="#ff5c00" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h3 class="font-montserrat text-[17px] font-semibold leading-[24px] text-[#020202] transition-colors group-hover:text-[#ff5c00]">
                            Why Goliath™?
                        </h3>
                        <p class="font-montserrat text-[14px] leading-[22px] text-[#6b7280]">
                            The case for permanent repair over replacement — lifetime warranty, 70% cost saving.
                        </p>
                    </div>
                    <span class="mt-auto font-montserrat text-[13px] font-semibold text-[#ff5c00]">Learn more &rarr;</span>
                </a>

                <!-- Services -->
                <a href="<?php echo esc_url(home_url('/services/')); ?>"
                   class="group flex flex-col gap-5 bg-white p-8 transition-shadow hover:shadow-md">
                    <div class="flex size-[52px] shrink-0 items-center justify-center bg-[#ff5c00]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <rect x="3" y="3" width="8" height="8" rx="1" fill="white"/>
                            <rect x="13" y="3" width="8" height="8" rx="1" fill="white"/>
                            <rect x="3" y="13" width="8" height="8" rx="1" fill="white"/>
                            <rect x="13" y="13" width="8" height="8" rx="1" fill="white"/>
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h3 class="font-montserrat text-[17px] font-semibold leading-[24px] text-[#020202] transition-colors group-hover:text-[#ff5c00]">
                            Services
                        </h3>
                        <p class="font-montserrat text-[14px] leading-[22px] text-[#6b7280]">
                            Repair, damage prevention, annual inspections, and racking installations.
                        </p>
                    </div>
                    <span class="mt-auto font-montserrat text-[13px] font-semibold text-[#ff5c00]">View services &rarr;</span>
                </a>

                <!-- How it works -->
                <a href="<?php echo esc_url(home_url('/how-it-works/')); ?>"
                   class="group flex flex-col gap-5 bg-white p-8 transition-shadow hover:shadow-md">
                    <div class="flex size-[52px] shrink-0 items-center justify-center bg-[#ff5c00]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" stroke="white" stroke-width="2"/>
                            <path d="M12 7v5l3 3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h3 class="font-montserrat text-[17px] font-semibold leading-[24px] text-[#020202] transition-colors group-hover:text-[#ff5c00]">
                            How it works
                        </h3>
                        <p class="font-montserrat text-[14px] leading-[22px] text-[#6b7280]">
                            30-minute installation with no hot works, no disruption, and no downtime.
                        </p>
                    </div>
                    <span class="mt-auto font-montserrat text-[13px] font-semibold text-[#ff5c00]">See the process &rarr;</span>
                </a>

                <!-- Case studies -->
                <a href="<?php echo esc_url(home_url('/case-studies/')); ?>"
                   class="group flex flex-col gap-5 bg-white p-8 transition-shadow hover:shadow-md">
                    <div class="flex size-[52px] shrink-0 items-center justify-center bg-[#ff5c00]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <rect x="4" y="3" width="16" height="18" rx="2" stroke="white" stroke-width="2"/>
                            <path d="M9 9h6M9 13h6M9 17h4" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h3 class="font-montserrat text-[17px] font-semibold leading-[24px] text-[#020202] transition-colors group-hover:text-[#ff5c00]">
                            Case studies
                        </h3>
                        <p class="font-montserrat text-[14px] leading-[22px] text-[#6b7280]">
                            Real results from UK warehouse operators who switched to Goliath.
                        </p>
                    </div>
                    <span class="mt-auto font-montserrat text-[13px] font-semibold text-[#ff5c00]">Read case studies &rarr;</span>
                </a>

                <!-- Videos -->
                <a href="<?php echo esc_url(home_url('/videos/')); ?>"
                   class="group flex flex-col gap-5 bg-white p-8 transition-shadow hover:shadow-md">
                    <div class="flex size-[52px] shrink-0 items-center justify-center bg-[#ff5c00]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <rect x="2" y="5" width="15" height="14" rx="2" stroke="white" stroke-width="2"/>
                            <path d="M17 9l5-3v12l-5-3V9z" fill="white"/>
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h3 class="font-montserrat text-[17px] font-semibold leading-[24px] text-[#020202] transition-colors group-hover:text-[#ff5c00]">
                            Videos
                        </h3>
                        <p class="font-montserrat text-[14px] leading-[22px] text-[#6b7280]">
                            Watch Goliath repairs in action — installation demos and crash tests.
                        </p>
                    </div>
                    <span class="mt-auto font-montserrat text-[13px] font-semibold text-[#ff5c00]">Watch videos &rarr;</span>
                </a>

                <!-- Contact -->
                <a href="<?php echo esc_url(home_url('/contact/')); ?>"
                   class="group flex flex-col gap-5 bg-white p-8 transition-shadow hover:shadow-md">
                    <div class="flex size-[52px] shrink-0 items-center justify-center bg-[#ff5c00]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A16 16 0 013 5a2 2 0 012-1z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h3 class="font-montserrat text-[17px] font-semibold leading-[24px] text-[#020202] transition-colors group-hover:text-[#ff5c00]">
                            Contact us
                        </h3>
                        <p class="font-montserrat text-[14px] leading-[22px] text-[#6b7280]">
                            Request a free racking assessment — SEMA-qualified team, one working day response.
                        </p>
                    </div>
                    <span class="mt-auto font-montserrat text-[13px] font-semibold text-[#ff5c00]">Get in touch &rarr;</span>
                </a>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
