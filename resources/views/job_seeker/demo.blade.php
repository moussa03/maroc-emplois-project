
@foreach($job_offers as $job_offer)
<div class="job-list-display filters ">
  <div class="job-img">
    <div>
    <img style="width: 250px;height: 150px;" src="{{asset('img/'.$job_offer->offer_image)}}">
    </div>
    {{-- <form action="{{route('show/single_offer',['id'=>$job_seeker->id,'offer_id'=>$job_offer->id])}}" method="GET"> --}}
    <button class="btn submit_job">
      <!-- Generated by IcoMoon.io -->
      {{-- <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"> --}}
      <span>postuler </span>
    </button>
  </form>
  </div>
  <div class="job-content">
    <span class="job-accesible text-danger">
      {{$job_offer->type_emploi}}
    </span>
    <span class="job-title font-weight-bold ">
      {{$job_offer->offer_title}}
    </span>
    <p class="job_description">
        {!!$job_offer->description!!}
    </p>
    <span class="apply-date">
      {{-- {{$date1->locale($boringLanguage)->diffForHumans($job_offer->created_at)}} --}}
  </span>

    <div class="location">
      <span class="city"><i class="fa fa-flag"></i> {{$job_offer->location->Name}}</span>

      <span class="country"><i class="fa fa-location-arrow"></i> {{$job_offer->category->Name}}</span>
    </div>
    <div class="job-salary">
      <span><i class="fa fa-location-arrow"></i></span>
      <span>{{$job_offer->salary->Name}}</span>
    </div>
    <div class="job-tags">
      <span><i class="fa fa-location-arrow"></i></span>
      <div>

      </div>
       @foreach ($job_offer->tags as $item)
       {{($item->Name)}}

       @endforeach
    </div>
    <div class="jobs-social">
      <div class="social">
        <span class="social-divider"><i class="fa fa-search"></i></span>
        <span class="social-divider"><i class="fa fa-search"></i></span>
        <span class="social-divider"><i class="fa fa-search"></i></span>
        <span><i class="fa fa-search"></i></span>
      </div>
    </div>
  </div>
</div>
@endforeach