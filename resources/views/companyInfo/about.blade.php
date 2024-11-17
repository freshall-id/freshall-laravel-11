<style>
    main.px-3.px-sm-5 {
    padding-left: 0 !important; /* Mengoverride padding Bootstrap */
    padding-right: 0 !important;
    }
</style>

@extends('auth.layout')

@section('content')
    <div class="container-fluid p-0">
        <div class="card bg-dark text-white  border-0" style="max-height:100%">
            <img src="{{ asset('freshall/about-banner.avif') }}" class="card-img" alt="about-banner" style="max-height:500px; object-fit:cover; filter:brightness(30%);">
            <div class="card-img-overlay text-align-center d-flex justify-content-center flex-column align-items-center" >
                <h5 class="card-title"></h5>
                <h1 class="text-center" style="font-size: 60px" >ALL FRESH FOR YOU</h1>
                <h1 class=" text-warning " style="font-size: 60px;" >FRESHALL</h1>
                <p class="card-text"></p>
            </div>
        </div>
    </div>
    <div class="container mt-5 p-5 d-flex flex-column justify-content-center align-items-center text-center gap-5">
        <h3 class="fw-bold">FreshAll adalah platform belanja online terpercaya <br> untuk kebutuhan groceries Anda.</h3>
        <p class="text-secondary fw-normal ">Didirikan dengan visi memberikan kemudahan berbelanja bahan makanan segar dan berkualitas langsung ke pintu rumah Anda. <br> 
            Dengan FreshAll, Anda bisa menemukan berbagai pilihan buah, sayur, dan kebutuhan sehari-hari lainnya, <br>
            semuanya dengan harga yang terjangkau dan layanan yang cepat.
            <br>Kami percaya bahwa berbelanja groceries harus  praktis, mudah, dan menyenangkan. Itulah sebabnya kami berkomitmen <br> untuk memberikan pengalaman berbelanja yang 
            memudahkan Anda, dengan dukungan pembayaran yang aman dan pengiriman yang efisien, setiap hari.
        </p>
        <a class="d-flex text-decoration-none" href="{{route('dashboard.page')}}">
            <button class="btn btn-warning text-decoration-none rounded-pill text-white px-5 py-2.5 fw-bold shadow-sm p-3 mb-5 ">Explore</button>
        </a>
    </div>
    <div>
        <div class="container card mb-3 border d-flex p-0 shadow-sm" style="max-width: 80%; max-height:100%">
            <div class="row g-0 align-items-center" style="height:30%">
              <div class="col-md-6 " style="">
                <img src="{{asset('freshall/misi-pic.jpg')}}" class="img-fluid rounded-start  w-100"  style="height:400px " alt="..." >
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <div class="card-body">
                  <h1 class="card-title fw-bold">MISI FRESHALL</h1>
                  <p class="card-text lh-base text-secondary" style="text-align: justify ">Menyediakan akses yang mudah, cepat, dan terjangkau kepada pelanggan untuk membeli bahan makanan segar, sayuran, buah-buahan, dan kebutuhan sehari-hari lainnya, langsung dari rumah mereka. Kami berkomitmen untuk meningkatkan pengalaman belanja online dengan menawarkan produk berkualitas, harga yang bersaing, dan pengiriman yang tepat waktu, sambil mempromosikan gaya hidup sehat dan keberlanjutan.</p>
                  <p class="card-text"><small class="text-muted"></small></p>
                </div>
              </div>
            </div>
          </div>
    </div>

    <div class="d-flex flex-column align-items-center justify-content-center container mb-5" style="margin-top:110px">
        <h3 class="text-warning">OUR VALUES</h3>
        <h1 class="text-center mt-3" style="font-weight: 600;">Kami berpegang pada nilai-nilai yang <br>membimbing setiap langkah kami.</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-5 h-100" style="width:90%;height:100%">
          <div class="col">
            <div class="card h-100 border-2" style="border-radius: 25px;">
              <img src="{{asset('freshall/values-pic1.avif')}}" class="card-img-top h-50" style="object-fit:cover; border-top-right-radius:25px; border-top-left-radius: 25px;"alt="...">
              <div class="card-body h-150 text-center">
                <h5 class="card-title">Freshness Guaranteed</h5>
                <p class="card-text text-secondary" style="font-weight:500">Kami memastikan semua produk yang kami tawarkan segar, berkualitas tinggi, dan dipetik langsung dari sumber terpercaya. Belanja bahan segar tak pernah semudah ini!</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 border-2" style="border-radius: 25px;">
              <img src="{{asset('freshall/values-pic2.avif')}}" class="card-img-top h-50" style="object-fit:cover; border-top-right-radius:25px; border-top-left-radius: 25px;"alt="...">
              <div class="card-body h-150 text-center">
                <h5 class="card-title">Convenience</h5>
                <p class="card-text text-secondary" style="font-weight:500">Hemat waktu dan tenaga dengan layanan belanja online kami. Pesan dari mana saja, kapan saja, dan kami akan mengantarkan kebutuhan Anda langsung ke pintu rumah.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 border-2" style="border-radius: 25px;">
              <img src="{{asset('freshall/values-pic3.jpg')}}" class="card-img-top h-50" style="object-fit:cover;  border-top-right-radius:25px; border-top-left-radius: 25px;"  alt="...">
              <div class="card-body h-150 text-center">
                <h5 class="card-title ">Sustainability Matters</h5>
                <p class="card-text text-secondary" style="font-weight:500">Kami peduli terhadap lingkungan. Dengan bekerja sama dengan petani lokal dan mengurangi limbah kemasan, kami berkomitmen untuk menjaga bumi tetap hijau.</p>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
