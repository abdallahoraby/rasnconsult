<section class="our-clients py-5">
    <div class="container">
        <div class="our-clients__panel rounded-4 p-4 p-md-5">
            <div class="text-center mb-4">
                <h2 class="our-clients__title fw-bold mb-3">Our Clients</h2>
                <p class="our-clients__lead mb-1">
                    Businesses across Europe, USA, and the Middle East rely on RASN for mission-critical software solutions.
                </p>
                <p class="our-clients__lead mb-0">Our clients experience:</p>
            </div>

            <div class="row g-3 g-md-4 mb-5">
                <div class="col-12 col-md-4">
                    <div class="our-clients__stat rounded-4 h-100 d-flex align-items-center justify-content-center text-center px-4 py-4">
                        97% Project Success Rate with on-time delivery
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="our-clients__stat rounded-4 h-100 d-flex align-items-center justify-content-center text-center px-4 py-4">
                        40% Average Efficiency Improvement for their operations
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="our-clients__stat rounded-4 h-100 d-flex align-items-center justify-content-center text-center px-4 py-4">
                        1-Month Quality Warranty on all development work
                    </div>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 align-items-center justify-content-center our-clients__logos">
                <div class="col text-center"><img src="https://dummyimage.com/160x50/ffffff/0f172a&text=paystone" alt="Paystone" class="img-fluid" /></div>
                <div class="col text-center"><img src="https://dummyimage.com/160x50/ffffff/1e3a8a&text=Adam+Travel" alt="Adam Travel" class="img-fluid" /></div>
                <div class="col text-center"><img src="https://dummyimage.com/160x50/ffffff/d946ef&text=Group+Trip" alt="Group Trip" class="img-fluid" /></div>
                <div class="col text-center"><img src="https://dummyimage.com/160x50/8b6f47/ffffff&text=TANEFER" alt="Tanefer" class="img-fluid" /></div>
                <div class="col text-center"><img src="https://dummyimage.com/160x50/ffffff/64748b&text=EJADA" alt="Ejada" class="img-fluid" /></div>
                <div class="col text-center"><img src="https://dummyimage.com/160x50/ffffff/1e40af&text=Crest" alt="Client" class="img-fluid" /></div>
            </div>
        </div>
    </div>
</section>


<style>
    :root {
        --oc-bg-start: #eef4fb;
        --oc-bg-end: #f5f8fc;
        --oc-text: #0f172a;
        --oc-muted: #475569;
        --oc-border: #e2e8f0;
        --oc-card-bg: #ffffff;
    }
    
    .our-clients__panel {
        background: linear-gradient(135deg, var(--oc-bg-start), var(--oc-bg-end));
        border: 1px solid var(--oc-border);
    }

    .our-clients__title {
        font-size: clamp(1.5rem, 2.4vw, 2rem);
        color: var(--oc-text);
        letter-spacing: -0.01em;
    }

    .our-clients__lead {
        color: var(--oc-muted);
        font-size: 1rem;
        line-height: 1.6;
    }

    .our-clients__stat {
        background: var(--oc-card-bg);
        border: 1px solid var(--oc-border);
        color: var(--oc-text);
        font-size: 0.95rem;
        line-height: 1.6;
        min-height: 110px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .our-clients__stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
    }

    .our-clients__logos img {
        max-height: 48px;
        width: auto;
        object-fit: contain;
        filter: grayscale(0);
        opacity: 0.95;
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .our-clients__logos img:hover {
        opacity: 1;
        transform: scale(1.04);
    }

    @media (max-width: 575.98px) {
        .our-clients__panel { padding: 1.25rem; }
        .our-clients__logos img { max-height: 36px; }
    }

</style>