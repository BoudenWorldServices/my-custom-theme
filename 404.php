<?php get_header(); ?>

<main class="w-full bg-white overflow-x-hidden">
    <section class="relative w-full h-auto lg:h-[400px] hero-gradient-bg">
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-16 pb-10 sm:px-6 lg:px-[68px] lg:pt-[100px] lg:pb-0">
            <div class="flex w-full flex-col items-center text-center">
                <p class="font-montserrat text-[80px] font-bold leading-none text-[#ff5c00] lg:text-[120px]">404</p>
                <h1 class="mt-4 font-montserrat text-[30px] font-bold leading-[40px] text-white sm:text-[36px] lg:text-[44px] lg:leading-[52px]">
                    Page not found
                </h1>
                <p class="mt-4 max-w-[600px] font-montserrat text-[17px] font-normal leading-[28px] text-white/80 lg:text-[20px] lg:leading-[32px]">
                    The page you're looking for doesn't exist or has been moved. Try one of the links below.
                </p>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <div class="flex flex-col items-center gap-6 sm:flex-row sm:justify-center sm:gap-8">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                   class="inline-flex h-[52px] w-full items-center justify-center bg-[#ff5c00] font-roboto text-[16px] font-semibold text-white transition-colors hover:bg-[#e55200] sm:w-[220px]">
                    Back to homepage
                </a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>"
                   class="inline-flex h-[52px] w-full items-center justify-center border-2 border-[#020202] font-roboto text-[16px] font-semibold text-[#020202] transition-colors hover:bg-[#020202] hover:text-white sm:w-[220px]">
                    View services
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>"
                   class="inline-flex h-[52px] w-full items-center justify-center border-2 border-[#020202] font-roboto text-[16px] font-semibold text-[#020202] transition-colors hover:bg-[#020202] hover:text-white sm:w-[220px]">
                    Contact us
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
