<h2>
    {{ $jobListing->title }}
</h2>
<p>
    Congrats! Your job listing is now live on our website.
</p>

<p>
    <a href="{{ url('/jobs/' . $jobListing->id) }}">View Your Job Listing</a>
</p>
