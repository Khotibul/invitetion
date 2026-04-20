<!-- Gallery Section -->
<section id="gallery" class="relative py-20 bg-gradient-to-br from-brown-50 via-cream-100 to-brown-100 overflow-hidden">
    <!-- Parallax Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-5">
        <svg class="parallax absolute top-20 right-10 w-48 h-48 text-brown-400" data-speed="0.2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
    </div>

    <div class="relative z-10 container mx-auto px-4 max-w-6xl">
        <!-- Header -->
        <div class="text-center mb-16 animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-5xl md:text-6xl font-script text-brown-800 mb-4">Our Gallery</h2>
            <div class="flex items-center justify-center gap-4 mt-6">
                <div class="w-20 h-0.5 bg-gradient-to-r from-transparent to-brown-400"></div>
                <svg class="w-6 h-6 text-brown-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <div class="w-20 h-0.5 bg-gradient-to-l from-transparent to-brown-400"></div>
            </div>
            <p class="text-brown-700 mt-6 max-w-2xl mx-auto">
                Momen indah yang telah kami lalui bersama
            </p>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 stagger-animation">
            @foreach([
                'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&h=600&fit=crop',
                'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=600&h=600&fit=crop',
                'https://images.unsplash.com/photo-1591604466107-ec97de577aff?w=600&h=600&fit=crop',
                'https://images.unsplash.com/photo-1623428187969-5da2dcea5ebf?w=600&h=600&fit=crop',
                'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=600&h=600&fit=crop',
                'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=600&h=600&fit=crop'
            ] as $index => $image)
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 aspect-square border-2 border-brown-200">
                <!-- Leaf Corner Ornaments -->
                <svg class="absolute top-2 left-2 w-8 h-8 text-cream-100 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                </svg>
                <svg class="absolute top-2 right-2 w-8 h-8 text-cream-100 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform rotate-90" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                </svg>

                <!-- Image -->
                <img
                    src="{{ $image }}"
                    alt="Gallery {{ $index + 1 }}"
                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500 cursor-pointer"
                    onclick="openLightbox({{ $index }})"
                >

                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-brown-900/60 via-brown-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <!-- Zoom Icon -->
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg class="w-12 h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                    </svg>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Bottom Grass -->
    <div class="absolute bottom-0 left-0 right-0 pointer-events-none">
        <svg class="w-full h-20 text-brown-700 opacity-10" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,10 Q150,50 300,30 T600,10 Q750,50 900,30 T1200,10 L1200,120 L0,120 Z" fill="currentColor"/>
        </svg>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-brown-300 transition-colors">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <button onclick="previousImage()" class="absolute left-4 text-white hover:text-brown-300 transition-colors">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>

    <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[90vh] object-contain rounded-lg border-4 border-brown-300 shadow-2xl">

    <button onclick="nextImage()" class="absolute right-4 text-white hover:text-brown-300 transition-colors">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>

    <div id="lightbox-counter" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white text-lg font-medium bg-brown-800/80 px-4 py-2 rounded-full"></div>
</div>

<script>
const galleryImages = [
    'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&h=1200&fit=crop',
    'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=1200&h=1200&fit=crop',
    'https://images.unsplash.com/photo-1591604466107-ec97de577aff?w=1200&h=1200&fit=crop',
    'https://images.unsplash.com/photo-1623428187969-5da2dcea5ebf?w=1200&h=1200&fit=crop',
    'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=1200&h=1200&fit=crop',
    'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=1200&h=1200&fit=crop'
];

let currentImageIndex = 0;

function openLightbox(index) {
    currentImageIndex = index;
    updateLightboxImage();
    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function updateLightboxImage() {
    document.getElementById('lightbox-img').src = galleryImages[currentImageIndex];
    document.getElementById('lightbox-counter').textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    updateLightboxImage();
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    updateLightboxImage();
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox.classList.contains('hidden')) {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') previousImage();
        if (e.key === 'ArrowRight') nextImage();
    }
});

// Close on background click
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});
</script>
