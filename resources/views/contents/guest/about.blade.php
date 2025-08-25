
@extends('layouts.guest')
@section('css')
    <title>Tentang Kami - Buku Wawasan Hindu</title>
<link rel="icon" href="{{ url('assets/images/favicon.png') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" type="image/x-icon">
  <meta name="description" content="Cari tahu tentang kami lebih detail terkait buku wawasan hindu">
   

        <style>
        
        .article-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .article-header {
            margin: 3rem 0;
        }

        .article-title {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 1.5rem;
        }

        .article-meta {
            color: #666;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .article-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-image {
            width: 100%;
            border-radius: 8px;
            margin: 2rem 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 2rem auto;
            display: block;
        }

        .article-content blockquote {
            border-left: 4px solid var(--primary);
            padding: 1rem 1.5rem;
            margin: 2rem 0;
            background: #f8f9fa;
            font-style: italic;
        }

        .author-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 2rem;
            margin: 3rem 0;
        }

        .author-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .author-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--accent);
        }

        .author-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.2rem;
        }

        .author-title {
            color: #666;
            font-size: 0.9rem;
        }

        .share-section {
            margin: 3rem 0;
            padding: 1.5rem 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .share-title {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .share-buttons {
            display: flex;
            gap: 1rem;
        }

        .share-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .share-button.facebook {
            background: #3b5998;
            color: white;
        }

        .share-button.twitter {
            background: #1da1f2;
            color: white;
        }

        .share-button.whatsapp {
            background: #25d366;
            color: white;
        }

        .related-articles {
            margin: 4rem 0;
        }

        .related-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
        }

        .related-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .related-image {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }

        .related-body {
            padding: 1.5rem;
        }

        .related-category {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .related-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .related-date {
            color: #666;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .article-title {
                font-size: 1.8rem;
            }
            
            .author-header {
                flex-direction: column;
                text-align: center;
            }
            
            .share-buttons {
                flex-direction: column;
            }
        }
             .articles-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 300px;
        }

    </style>
@endsection
@section('content')
    
    <!-- Hero Section -->
    <section class="articles-hero d-flex align-items-center justify-content-center text-white">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Tentang Kami</h1>
            <p class="lead">Temukan kebijaksanaan dalam koleksi artikel kami</p>
        </div>
    </section>

        <!-- Related Articles -->
       <section class="py-5 bg-light">
        <div class="container ">
                {!! $configs->about !!}
            </div>
        </section>

@endsection