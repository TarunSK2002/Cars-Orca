@extends('customer.layout')

@section('title', 'About Us - Cars Orca')

@section('content')
<div class="glass-card p-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h1 class="display-5 fw-bold glow-text mb-0" id="about-title">About Cars Orca</h1>
        <div class="d-flex gap-2 mt-2 mt-md-0">
            <button class="btn btn-sm btn-outline-info active rounded-pill px-3" id="btn-en" onclick="switchLang('en')">English</button>
            <button class="btn btn-sm btn-outline-info rounded-pill px-3" id="btn-ta" onclick="switchLang('ta')">தமிழ்</button>
        </div>
    </div>
    
    <!-- English Section -->
    <div id="about-en" class="row g-4 align-items-center">
        <div class="col-md-7">
            <p class="lead text-white fw-bold">
                At CarsOrca, we are committed to offering only quality cars you can trust.
            </p>
            <p class="text-white opacity-75">
                Every pre-owned vehicle we sell goes through a complete inspection process, including detailed condition checks and proper document verification. Only after meeting our standards, a car is made ready for sale — so you can choose with 100% confidence.
            </p>
            <p class="text-white opacity-75">
                If you're planning to sell your car, CarsOrca makes the process simple and reliable. Bring your vehicle to us, and our team will handle everything — from inspection to finding the right buyer. We aim to complete the sale within 10 days and ensure you receive your payment without hassle.
            </p>
            <p class="text-white opacity-75">
                During this period, your car is kept safe under our responsibility with proper agreement and trust. We make sure your vehicle is handled with care, without any damage, until it reaches the right buyer.
            </p>
            <p class="text-white opacity-75">
                At CarsOrca, customers are not just clients — you become a part of the Orca family. Whether you are buying or selling, you can rely on us for a smooth, secure, and transparent experience.
            </p>
            <h5 class="fw-bold glow-text mt-3">CarsOrca — Drive with Trust.</h5>
        </div>
        <div class="col-md-5">
            <div class="p-4 border border-secondary bg-dark bg-opacity-25 rounded-3 d-flex flex-column gap-3">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-file-contract text-info fs-3 me-3"></i>
                    <div>
                        <h6 class="fw-bold mb-0">Clear Titles Verified</h6>
                        <span class="small text-muted">Zero legal ambiguities.</span>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-calculator text-primary fs-3 me-3"></i>
                    <div>
                        <h6 class="fw-bold mb-0">Automated Pricing</h6>
                        <span class="small text-muted">Fixed upfront cost structures.</span>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-shield-halved text-success fs-3 me-3"></i>
                    <div>
                        <h6 class="fw-bold mb-0">Condition Check</h6>
                        <span class="small text-muted">True diagnostic states.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tamil Section -->
    <div id="about-ta" class="row g-4 align-items-center d-none">
        <div class="col-md-7">
            <p class="lead text-white fw-bold">
                CarsOrca-வில், நாங்கள் நம்பிக்கைக்குரிய தரமான கார்கள் மட்டுமே விற்பனை செய்கிறோம்.
            </p>
            <p class="text-white opacity-75">
                எங்கள் மூலம் விற்கப்படும் அனைத்து பயன்படுத்தப்பட்ட (Second-hand) கார்கள் முழுமையான ஆய்வுக்கு உட்படுத்தப்படுகின்றன. கார் condition, engine, performance மற்றும் அனைத்து documents சரியாக உள்ளதா என்று முழுமையாக சரிபார்த்த பிறகே விற்பனைக்கு தயாராக்கப்படும். அதனால், நீங்கள் 100% நம்பிக்கையுடன் வாங்கலாம்.
            </p>
            <p class="text-white opacity-75">
                நீங்கள் உங்கள் காரை விற்க நினைத்தால், CarsOrca உங்களுக்கு எளிதான மற்றும் பாதுகாப்பான முறையை வழங்குகிறது. உங்கள் காரை எங்களிடம் கொண்டு வந்தால், ஆய்வு முதல் விற்பனை வரை அனைத்தையும் நாங்கள் கவனிப்போம். 10 நாட்களுக்குள் உங்கள் காரை விற்பனை செய்து, பணத்தை எந்த சிரமமும் இல்லாமல் உங்களிடம் வழங்குவதே எங்கள் நோக்கம்.
            </p>
            <p class="text-white opacity-75">
                இந்த காலத்தில், உங்கள் கார் எங்கள் பொறுப்பில் பாதுகாப்பாக வைக்கப்படும். எந்த சேதமும் இல்லாமல், முறையான agreement மற்றும் நம்பிக்கையுடன் உங்கள் வாகனம் பாதுகாக்கப்படும்.
            </p>
            <p class="text-white opacity-75">
                CarsOrca-வில், நீங்கள் ஒரு customer மட்டும் அல்ல — Orca குடும்பத்தின் ஒரு உறுப்பினர். வாங்குவதோ, விற்பதோ எதுவாக இருந்தாலும், நம்பிக்கையுடன் எங்களை அணுகலாம்.
            </p>
            <h5 class="fw-bold glow-text mt-3">CarsOrca — நம்பிக்கையுடன் ஓட்டுங்கள்.</h5>
        </div>
        <div class="col-md-5">
            <div class="p-4 border border-secondary bg-dark bg-opacity-25 rounded-3 d-flex flex-column gap-3">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-file-contract text-info fs-3 me-3"></i>
                    <div>
                        <h6 class="fw-bold mb-0">ஆவணங்கள் சரிபார்ப்பு</h6>
                        <span class="small text-muted">சட்ட சிக்கல்கள் இல்லை.</span>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-calculator text-primary fs-3 me-3"></i>
                    <div>
                        <h6 class="fw-bold mb-0">சரியான விலை</h6>
                        <span class="small text-muted">முன்பண வெளிப்படைத்தன்மை.</span>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-shield-halved text-success fs-3 me-3"></i>
                    <div>
                        <h6 class="fw-bold mb-0">தரமான ஆய்வு</h6>
                        <span class="small text-muted">முழுமையான கார் சோதனை.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchLang(lang) {
        if (lang === 'en') {
            document.getElementById('about-en').classList.remove('d-none');
            document.getElementById('about-ta').classList.add('d-none');
            document.getElementById('btn-en').classList.add('active');
            document.getElementById('btn-ta').classList.remove('active');
            document.getElementById('about-title').innerText = "About Cars Orca";
        } else {
            document.getElementById('about-en').classList.add('d-none');
            document.getElementById('about-ta').classList.remove('d-none');
            document.getElementById('btn-en').classList.remove('active');
            document.getElementById('btn-ta').classList.add('active');
            document.getElementById('about-title').innerText = "Cars Orca பற்றி";
        }
    }
</script>
@endsection
