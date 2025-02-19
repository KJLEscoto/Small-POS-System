<article class="wrapper">
    <div class="marquee">
        <div class="marquee__group">
            <img src="{{ asset('img/school-logo/rweb.png') }}" alt="rweb">
            <img src="{{ asset('img/school-logo/sti.png') }}" alt="sti">
            <img src="{{ asset('img/school-logo/addu.png') }}" alt="addu">
            <img src="{{ asset('img/school-logo/hcdc.png') }}" alt="hcdc">
            <img src="{{ asset('img/school-logo/um.png') }}" alt="um">
            <img src="{{ asset('img/school-logo/rweb.png') }}" alt="rweb">
            <img src="{{ asset('img/school-logo/sti.png') }}" alt="sti">
            <img src="{{ asset('img/school-logo/addu.png') }}" alt="addu">
            <img src="{{ asset('img/school-logo/hcdc.png') }}" alt="hcdc">
            <img src="{{ asset('img/school-logo/um.png') }}" alt="um">
        </div>

        <div aria-hidden="true" class="marquee__group">
            <img src="{{ asset('img/school-logo/rweb.png') }}" alt="rweb">
            <img src="{{ asset('img/school-logo/sti.png') }}" alt="sti">
            <img src="{{ asset('img/school-logo/addu.png') }}" alt="addu">
            <img src="{{ asset('img/school-logo/hcdc.png') }}" alt="hcdc">
            <img src="{{ asset('img/school-logo/um.png') }}" alt="um">
            <img src="{{ asset('img/school-logo/rweb.png') }}" alt="rweb">
            <img src="{{ asset('img/school-logo/sti.png') }}" alt="sti">
            <img src="{{ asset('img/school-logo/addu.png') }}" alt="addu">
            <img src="{{ asset('img/school-logo/hcdc.png') }}" alt="hcdc">
            <img src="{{ asset('img/school-logo/um.png') }}" alt="um">
        </div>
    </div>
</article>

<style>
    :root {
        --gap: 1rem;
        --duration: 60s;
        --scroll-start: 0;
        --scroll-end: -100%;
    }

    * {
        box-sizing: border-box;
    }

    body {
        display: grid;
        align-content: center;
        overflow: hidden;
        width: 100%;
        min-height: 100vh;
        font-family: system-ui, sans-serif;
        background-color: white;
    }

    .marquee {
        display: flex;
        overflow: hidden;
        user-select: none;
        gap: var(--gap);
        mask-image: linear-gradient(to right,
                rgba(0, 0, 0, 0),
                rgba(0, 0, 0, 1) 20%,
                rgba(0, 0, 0, 1) 80%,
                rgba(0, 0, 0, 0));
    }

    .marquee__group {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: space-around;
        gap: var(--gap);
        min-width: 100%;
        animation: scroll-x var(--duration) linear infinite;
    }

    @keyframes scroll-x {
        from {
            transform: translateX(var(--scroll-start));
        }

        to {
            transform: translateX(var(--scroll-end));
        }
    }

    .marquee img {
        height: 60px;
        /* Adjust height as needed */
        width: auto;
    }

    /* Parent wrapper */
    .wrapper {
        display: flex;
        flex-direction: column;
        gap: var(--gap);
        margin: auto;
        max-width: 100vw;
    }
</style>
