@extends('front_end.layouts.master')
@section('extrastyle')
<style>

  .container-ex {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f8f8f8;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  h1 {
    text-align: center;
    color: #333;
  }
  .star-rating {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }
  .star-rating input {
    display: none;
  }
  .star-rating label {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
  }
  .star-rating input:checked ~ label,
  .star-rating label:hover,
  .star-rating label:hover ~ label {
    color: #f5b301;
  }
  .review-form {
    text-align: center;
  }
  .review-form textarea {
    width: 100%;
    padding: 10px;
    margin: 20px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }
  .review-form button {
    padding: 10px 20px;
    border: none;
    background-color: #28a745;
    color: white;
    font-size: 1rem;
    border-radius: 4px;
    cursor: pointer;
  }
  .review-form button:hover {
    background-color: #218838;
  }
  .reviews {
    margin-top: 40px;
  }
  .review {
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
  }
  .review:last-child {
    border-bottom: none;
  }
  .review strong {
    display: block;
    margin-bottom: 5px;
  }
  .review em {
    color: #666;
    font-size: 0.9rem;
  }
</style>
@endsection
@section('content')
<div class ="row justify-content-center">
  <div class="widget widget_services rounded-sidebar-widget col-8" >
    <h1>Leave a Review</h1>
  
    <form method="POST" action="{{ route('submitReview') }}">
      <div class="star-rating" dir="rtl">
        <input type="radio" id="star5" name="rating" value="5" required/>
        <label for="star5">&#9733;</label>
        <input type="radio" id="star4" name="rating" value="4" required/>
        <label for="star4">&#9733;</label>
        <input type="radio" id="star3" name="rating" value="3" required/>
        <label for="star3">&#9733;</label>
        <input type="radio" id="star2" name="rating" value="2" required/>
        <label for="star2">&#9733;</label>
        <input type="radio" id="star1" name="rating" value="1" required/>
        <label for="star1">&#9733;</label>
      </div>
  
      <input type="hidden" name="reviewLeadCheckerId" value="{{ $reviewLeadCheckerId }}">
  
      @csrf
  
      <div class="review-form">
        <textarea placeholder="Leave a review..." rows="4" name="comment" required></textarea>
        <br/>
        <button>Submit Review</button>
      </div>
    </form>  
  
    {{-- <div class="reviews">
      <h2>Reviews</h2>
      <div class="review">
        <strong>Rating: 5 stars</strong>
        <p>Great product, highly recommend!</p>
        <em>Submitted on: 2024-05-26</em>
      </div>
    </div> --}}
  </div>
</div>


@endsection