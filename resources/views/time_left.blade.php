@if(\App\Models\Vote::time_left() > 0)
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
    </svg>

    <div class="alert alert-primary d-flex align-items-center mt-3" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
        <div>
            Voting is active.  Results will be available in <span class="font-monospace" id="timeLeft"></span>.
            @php $total_votes = count(\App\Models\Vote::all()) @endphp
            @if($total_votes == 1)
                There is currently <b>{{ $total_votes }}</b> vote.
            @else
                There are currently <b>{{ $total_votes }}</b> votes.
            @endif
        </div>
    </div>

    <script>
        var distance = {{ \App\Models\Vote::time_left() }};

        update()

        var x = setInterval(update, 1000);

        function update() {
            distance = distance - 1000;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timeLeft").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timeLeft").innerHTML = "0d 0h 0m 0s";
                window.location.reload(true);
            }
        }
    </script>
@endif
