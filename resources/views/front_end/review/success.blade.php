@extends('front_end.layouts.master')
@section('extrastyle')
<style>

  .checkmark {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: inline-block;
    background-color: #4caf50;
    position: relative;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
  .checkmark::before {
    content: '';
    width: 50px;
    height: 25px;
    border: solid white;
    border-width: 0 0 6px 6px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-45deg);
    opacity: 0;
    animation: draw 0.5s 0.3s ease-in-out forwards;
  }
  @keyframes draw {
    from {
      opacity: 0;
      width: 0;
      height: 0;
    }
    to {
      opacity: 1;
      width: 50px;
      height: 25px;
    }
  }
  .message {
    font-size: 1.5rem;
    color: #333;
  }
</style>

@endsection
@section('content')

    <div class ="row justify-content-center">
        <div class="widget widget_services rounded-sidebar-widget col-8 ">
            <div class="justify-content-center" style=" text-align: center;">
            <div class="checkmark"></div>
            <div class="message">Thank you Review Submitted Successfully!</div>
        </div>
        </div>
    </div>
@endsection



