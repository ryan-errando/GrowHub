@extends('layout.user')

@section('title', 'Order Success')

@section('content')
<div class="container py-5">
    <div class="text-center" style="max-width: 800px; margin: 0 auto;">
        <h1 style="color: #1b4332; font-size: 3rem; margin-bottom: 2rem;">We've got your order!</h1>
        
        <p style="color: #1b4332; font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
            From the bottom of our hearts, thank you for choosing to bring a plant into your home. Each plant we carefully nurture represents more than just a product – it's a living piece of nature's art, a promise of growth, and a connection to the lush, vibrant world beyond your walls. We pour our passion into every single plant, and knowing it will become a cherished part of your personal space fills us with genuine joy. Your support allows us to continue sharing the beauty of these extraordinary plants, and we are truly grateful that you've welcomed one of our green companions into your life. We hope our plants brings you as much happiness and wonder as it brought us in cultivating it.
        </p>

        <p style="color: #1b4332; font-size: 1.2rem; margin-bottom: 0.5rem;">
            With Love,
        </p>
        <p style="color: #1b4332; font-size: 1.2rem; margin-bottom: 3rem;">
            GrowHub team
        </p>

        <a href="/orderProducts" class="btn" style="background-color: #1b4332; color: white; border: none; padding: 0.75rem 2rem; font-size: 1.1rem;">
            View Orders
        </a>
    </div>
</div>
@endsection