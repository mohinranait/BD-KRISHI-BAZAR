
<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        /*Setting Basic Dimensions to give
        gallery view */
        /* .container{
            margin: 0 auto;
            width: 90%;
        } */
        /* .main_view{
            width: 80%;
            height: 25rem;
        } */
        /* .main_view img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        } */
        /* .side_view{
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        } */
        /* .side_view img{
            width: 9rem;
            height: 7rem;
            object-fit: cover;
            cursor: pointer;
            margin:0.5rem;
        } */
    </style>
</head>

<body>
    <!-- Container for our gallery -->
    <div class="container">

        <!-- Main view of our gallery -->
        <div class="main_view">
            <img src="{{asset('storage/subject/file/'.$ad->image)}}" id="main" alt="IMAGE">
        </div>

        <!-- All images with side view -->
        <div class="side_view">
            @foreach ($ad->images as $img)
            <img src="{{ asset('storage/subject/file/extra/'.$img->image) }}" onclick="change(this.src)">
            @endforeach

        </div>
    </div>

    <script type="text/javascript">
        const change = src => {
            document.getElementById('main').src = src
        }
    </script>
</body>

</html>
