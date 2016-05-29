@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Your API key is <b>{{ Auth::user()->api_token }}</b>
                    <br>
                    Your current location is set to <b>{{Auth::user()->location}}</b>
                        <br><br>
                        <b>Set New location</b>
                        <form method="post" action="/setlocation">
                        {{ csrf_field() }}
      <input id="geocomplete" type="text" name="location" placeholder="Type in an address" size="90" class="form-control" />
      <br>
      <button type="submit" class="btn btn-info btn-block">Submit</button>
    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $( document ).ready(function(){

        $("#geocomplete").geocomplete()
          .bind("geocode:result", function(event, result){
            $.log("Result: " + result.formatted_address);
          })
          .bind("geocode:error", function(event, status){
            $.log("ERROR: " + status);
          })
          .bind("geocode:multiple", function(event, results){
            $.log("Multiple: " + results.length + " results found");
          });

        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });


        $("#examples a").click(function(){
          $("#geocomplete").val($(this).text()).trigger("geocode");
          return false;
        });

      });
    </script>
@endsection
