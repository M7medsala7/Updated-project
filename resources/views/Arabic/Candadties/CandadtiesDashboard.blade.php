@extends('Layout.app')

<style type="text/css">
  .header{
    position: relative!important;
  }
</style>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm3O5N1fP52tnpdSqPt71joqjd9xOkcek"></script>

<script type="text/javascript">  
 
</script>

@section('content')

<section class="dashboard">
  <div class="container">
    <div class="row">
      <div class="col-sm-3 dashboardleft">
        <div class="inner-aboutus padbotnm">
          <div class="linksing viewprofile">
            <div class="profileleft"> <img src="{{(\Auth::user()->logo)?(\Auth::user()->logo):'images/callto-action.png'}}"> <a href="#" class="fas fa-pencil-alt"> </a> </div>
            <!--profileleft-->
            
            <div class="detalsprofile">
              <h4 class="textcandidate">{{(\Auth::user()->name)?(\Auth::user()->name):'No Name'}} , {{$age}}</h4>
              <span>{{$jobName->name}} </span> </div>
            <!--detalsprofile--> 
            
          </div>
          
          <!--viewprofile-->
          
          <div class="text-only">profile strength: <span>60%</span></div>
          <div class="progress">
            <div class="progress-bar" style="width: 60%;"></div>
          </div>
          <!--progress-->
          
          <div class="pointsnamber"> <i class="fas fa-trophy"></i>
            <p>you have <span>{{$CandidateInfo->coins}}</span> points</p>

          </div>
          <!--pointsnamber-->
          
          <div class="videoprofy"> <a href="#" data-toggle="modal" data-target="#myModal" class="watchvideo"> <img src="images/slide5.jpg"> <i class="fas fa-play"></i> </a>
            <div class="centbotmm"><a href="#" class="skiplink">view profile </a></div>
          </div>
          <!--videoprofy--> 
          
        </div>
        <!--inner-aboutus-->
        
        <div class="inner-aboutus topmergline padbotnm">
          <div class="detalsprofile ecome">
            <h4 class="textcandidate">4 tips to become a top candidate</h4>
          </div>
          <!--detalsprofile-->
          
          <ul class="hassle palrft">
            <li>find a job easily</li>
            <li>reach your employer directly</li>
            <li>forget about agencies hassle</li>
          </ul>
          <div class="videoprofy"> <a href="#" data-toggle="modal" data-target="#myModal" class="watchvideo"> <img src="images/slide5.jpg"> <i class="fas fa-play"></i>
            <p>watch demo video</p>
            </a>
            <div class="centbotmm"> <a href="#" class="skiplink">view more tips and articles </a> </div>
          </div>
          <!--videoprofy--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
      
      <div class="col-sm-9 dashboardleft"> 
        
        <!--headtext-->
        
        <div class="inner-aboutus">
          <div class="currencytext resultstext">
            <h2>recommended jobs</h2>
            <a href="#" class="prefrnces">edit job prefrnces <i class="fas fa-pencil-alt"></i></a> </div>
          <!--resultstext-->
          
          <div class="row">
            @foreach($RecommandJobs  as $val)
            <div class="col-sm-4 company com-dashboard">
              <div class="ineercompany">
                <div class="tidiv"> <img src="images/car1.jpg"> <span>{{$val->job_for}}</span></div>
                <!--tidiv-->
                
                <h4 class="innertitltext">Al Salam Auto Show </h4>
                <p class="officer">{{$val->job->name}}</p>
                <ul class="hassle salary">
                  <li> <strong>loc.</strong>{{$val->country->name}} </li>
                  <li> <strong>salary.</strong>{{$val->min_salary}}-{{$val->max_salary}} {{$val->Currency->name}}</li>
                </ul>
                <div class="tidivbotom"> <a href="#">apply now</a> <span>{{$val->created_at}}</span></div>
                <!--tidiv--> 
                
              </div>
              <!--inernews--> 
              
            </div>
            @endforeach
            <!--com-dashboard-->
            
           
            <!--com-dashboard--> 
            
          </div>
          <!--row-->
          <div id="map" style=" width: 100%; height: 70%;margin-top: 20px;"></div>

       <!--    <div class="map-iframe merwith">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3455.569680525106!2d31.429343215113878!3d29.991794581901466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjnCsDU5JzMwLjUiTiAzMcKwMjUnNTMuNSJF!5e0!3m2!1sen!2s!4v1464808219991" frameborder="0" style="border:0" allowfullscreen=""></iframe>
          </div> -->
          <!--map-iframe-->
          
          <div class="cenbottom nomergbotm"> <a href="#" class="largeredbtn">view more jobs</a> </div>
        </div>
        <!--inner-aboutus-->
        
        <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>your progress</h2>
          </div>
          <!--resultstext-->
          
          <div class="row">
            <div class="col-sm-3 profiledeta">
              <div class="innersprof"> <i class="fas fa-user"></i> </div>
              <h3>profile</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
            <!--profiledeta-->
            
            <div class="col-sm-3 profiledeta">
              <div class="innersprof"> <i class="fas fa-cloud-upload-alt"></i> </div>
              <h3>upload a video</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
            <!--profiledeta-->
            
            <div class="col-sm-3 profiledeta">
              <div class="innersprof nnersp"> <i class="fas fa-plug"></i> </div>
              <h3>online interview</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
            <!--profiledeta-->
            
            <div class="col-sm-3 profiledeta">
              <div class="innersprof nnersp"> <i class="fas fa-users"></i> </div>
              <h3>hiring</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
            <!--profiledeta--> 
            
          </div>
          <!--row--> 
          
        </div>
        
        <!--inner-aboutus-->
        
        <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>matching jobs</h2>
          </div>
          <!--resultstext-->
          
          <div class="row">
           @foreach($MatchingJobs  as $val)
            <div class="col-sm-4 company com-dashboard">
              <div class="ineercompany">
                <div class="tidiv"> <img src="images/car1.jpg"> <span>{{$val->job_for}}</span></div>
                <!--tidiv-->
                
                <h4 class="innertitltext">Al Salam Auto Show </h4>
                <p class="officer">{{$val->job->name}}</p>
                <ul class="hassle salary">
                  <li> <strong>loc.</strong>{{$val->country->name}} </li>
                  <li> <strong>salary.</strong>{{$val->min_salary}}-{{$val->max_salary}} {{$val->Currency->name}}</li>
                </ul>
                <div class="tidivbotom"> <a href="#">apply now</a> <span>{{$val->created_at}}</span></div>
                <!--tidiv--> 
                
              </div>
              <!--inernews--> 
              
            </div>
            @endforeach
            <!--com-dashboard-->

          </div>
          <!--row-->
          
          <div class="cenbottom nomergbotm"> <a href="#" class="largeredbtn">view more jobs</a> </div>
        </div>
        <!--inner-aboutus-->
        <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>candidates looking for the same job</h2>
          </div>
          <!--resultstext-->
          
          <div class="row">
            @foreach($Candidates as $val)
            <div class="col-sm-4 company com-dashboard">
              <div class="ineercompany nonepad"> <a href="#" class="imgbox"> <img src="images/4.jpg"> <i class="fas fa-play"></i></a>
                <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
                  <h4 class="innertitltext"></h4>
                  <p class="officer"></p>
                  <ul class="hassle salary">
                    <li></li>
                    <li></li>
                  </ul>
                  <div class="tidivbotom"> <a href="#">know more</a> <span></span></div>
                  <!--tidiv--> 
                  
                </div>
                <!--padboxs--> 
                
              </div>
              <!--inernews--> 
              
            </div>
            @endforeach
            <!--com-dashboard-->
          
            <!--com-dashboard--> 
            
          </div>
          <!--row-->
          
          <div class="cenbottom nomergbotm"> <a href="#" class="largeredbtn">view more candidates</a> </div>
        </div>
        
        <!--inner-aboutus--> 
        
      </div>
      
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 
    
  </div>
  
  <!--container--> 
  
</section>
<!--section-->

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox">
       
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->
@endsection
<script type="text/javascript"> 
 $(document).ready(function(){

   var map;
        map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng({{$CandidateInfo->country->Lan}},{{$CandidateInfo->country->Lat}}),
           mapTypeId: google.maps.MapTypeId.ROADMAP,
          zoom: 8
        });
         ajaxCall();
  });

function ajaxCall() {
  var marker,i;
   $.ajax({
        type: "GET",
        url : '{{url("/getjobsbycountry")}}',
        success: function(response) {
          var jArray = JSON.parse(response);
           console.log(jArray);
           
          var infowindow = new google.maps.InfoWindow();
          console.log(jArray.jobs.length);
                  for (i = 0; i < jArray.jobs.length; i++) {
            
                  marker = new google.maps.Marker({
                      position: new google.maps.LatLng(jArray.jobs[i].Lat, jArray.jobs[i].Long),
                      map: map
                  });
            
           
       var geocoder = new google.maps.Geocoder();
        var latitude = jArray.jobs[i].Lat;
        var longitude = jArray.jobs[i].Long;
        var address_arr = new Array();
        var latLng = new google.maps.LatLng(latitude,longitude);
        geocoder.geocode({       
            latLng: latLng     
          }, 
        function(responses) 
            {     
              if (responses && responses.length > 0) {    
                  address_arr.push(responses[0].formatted_address); 
              } 
              else{     
                  address_arr[i] = 'Not getting address for given latitude and longitude';  
              }   
            }
        );
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {           
            infowindow.setContent('Name '+jArray.jobs[i].Name+' <br/> Adress '+ jArray.jobs[i].Adress);
            infowindow.open(map, marker);
          }
        })(marker, i));


    markerArr[i]=marker;
    }
  }});
}

     


</script>
