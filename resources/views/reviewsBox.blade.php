<div class="detailsCommentBox">
      <div class="commentTitleBox">
        <p class="commentTitle">Reviews</p>
        <a href="{{ url('item/' . $ItemId . '/addReview') }}" class="btn btn-primary">Add Review</a>
      </div>   
      @if (count($reviews) > 0)
            @foreach ($reviews as $review)
            <div class="reviewBox">
                <p class="reviewUser">{{ $review->DisplayName }}</p>
                <p class="reviewRating">Rating: {{ $review->Rating }}/10</p>
                <p class="reviewBody">{{ $review->ReviewBody }}</p>
                <p class="reviewDate">Date: {{ $review->Date }}</p>
            </div>
            @endforeach
        @else
            <p>No reviews yet for this item.</p>
        @endif
</div>