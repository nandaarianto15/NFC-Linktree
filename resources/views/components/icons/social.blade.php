{{--
    Social Media Icon Component
    @param string $icon  - key nama platform (instagram, tiktok, youtube, dll)
    @param int    $size  - ukuran pixel SVG (default 20)
--}}
@php $size = $size ?? 20; @endphp

@switch($icon)

    {{-- INSTAGRAM --}}
    @case('instagram')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="ig-{{ $size }}" x1="0" y1="24" x2="24" y2="0" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stop-color="#FEDA75"/>
                    <stop offset="20%" stop-color="#FA7E1E"/>
                    <stop offset="45%" stop-color="#D62976"/>
                    <stop offset="70%" stop-color="#962FBF"/>
                    <stop offset="100%" stop-color="#4F5BD5"/>
                </linearGradient>
            </defs>
            <rect width="24" height="24" rx="5" fill="url(#ig-{{ $size }})"/>
            <g transform="translate(12, 12) scale(1.15) translate(-12, -12)">
                <path d="M12 8.122a3.878 3.878 0 1 0 0 7.756 3.878 3.878 0 0 0 0-7.756zm0 6.387a2.509 2.509 0 1 1 0-5.018 2.509 2.509 0 0 1 0 5.018z" fill="white"/>
                <path d="M16.25 8.3c0 .5-.4.9-.9.9s-.9-.4-.9-.9.4-.9.9-.9.9.4.9.9z" fill="white"/>
                <path d="M16.435 5.5H7.565A2.067 2.067 0 0 0 5.5 7.565v8.87c0 1.138.927 2.065 2.065 2.065h8.87a2.067 2.067 0 0 0 2.065-2.065v-8.87A2.067 2.067 0 0 0 16.435 5.5zm.696 10.935c0 .383-.313.696-.696.696H7.565a.697.697 0 0 1-.696-.696v-8.87c0-.383.313-.696.696-.696h8.87c.383 0 .696.313.696.696v8.87z" fill="white"/>
            </g>
        </svg>
    @break

    {{-- TIKTOK --}}
    @case('tiktok')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect width="24" height="24" rx="5" fill="#000000"/>
            <g transform="translate(3, 3) scale(0.75)">
                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" fill="white"/>
            </g>
        </svg>
    @break

    {{-- YOUTUBE --}}
    @case('youtube')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect width="24" height="24" rx="5" fill="#FF0000"/>
            <g transform="translate(3, 3) scale(0.75)">
                <path d="M8 6.5v11l9.5-5.5L8 6.5z" fill="white"/>
            </g>
        </svg>
    @break

    {{-- TWITTER / X --}}
    @case('twitter')
    @case('x')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect width="24" height="24" rx="5" fill="#000000"/>
            <g transform="translate(3, 3) scale(0.75)">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" fill="white"/>
            </g>
        </svg>
    @break

    {{-- FACEBOOK --}}
    @case('facebook')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect width="24" height="24" rx="5" fill="#1877F2"/>
            <g transform="translate(3, 3) scale(0.75)">
                <path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0014.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z" fill="white"/>
            </g>
        </svg>
    @break

    {{-- LINKEDIN --}}
    @case('linkedin')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect width="24" height="24" rx="5" fill="#0A66C2"/>
            <g transform="translate(3, 3) scale(0.75)">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452z" fill="white"/>
            </g>
        </svg>
    @break

    {{-- GITHUB --}}
    @case('github')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect width="24" height="24" rx="5" fill="#181717"/>
            <g transform="translate(3, 3) scale(0.75)">
                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" fill="white"/>
            </g>
        </svg>
    @break

    {{-- WHATSAPP --}}
    @case('whatsapp')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect width="24" height="24" rx="5" fill="#25D366"/>
            <g transform="translate(3, 3) scale(0.75)">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" fill="white"/>
            </g>
        </svg>
    @break

    {{-- TELEGRAM --}}
    @case('telegram')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="24" height="24" rx="5" fill="#2CA5E0"/>
            <path d="M17.574 6.787a.465.465 0 0 0-.448-.035l-12 4.646a.466.466 0 0 0-.012.857l2.844 1.037 6.816-4.29c.1-.063.224.074.14.162l-5.617 5.253v2.32a.466.466 0 0 0 .813.312l1.698-1.582 3.1 2.292a.466.466 0 0 0 .736-.25l2.25-10.5a.466.466 0 0 0-.32-.522z" fill="white"/>
        </svg>
    @break

    {{-- BEHANCE (Style seperti gambar - Centered) --}}
    @case('behance')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <rect width="24" height="24" rx="5" fill="#1769FF"/>

        <text
            x="50%"
            y="54%"
            fill="white"
            font-family="Arial, Helvetica, sans-serif"
            font-size="14"
            font-weight="900"
            letter-spacing="-1"
            text-anchor="middle"
            dominant-baseline="central">
            Bē
        </text>
    </svg>
    @break

    {{-- OTHER / LAINNYA --}}
    @case('other')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect width="24" height="24" rx="5" fill="#64748b"/>
            <g transform="translate(3, 3) scale(0.75)">
                <circle cx="6" cy="12" r="1.5" fill="white"/>
                <circle cx="12" cy="12" r="1.5" fill="white"/>
                <circle cx="18" cy="12" r="1.5" fill="white"/>
            </g>
        </svg>
    @break

    {{-- DEFAULT: link icon (fallback) --}}
    @default
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
        </svg>
@endswitch