<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Training Course Administration</title>
</head>
<body class=""
      style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
<div class="card-body" style="padding-left: 20px;">
    <div class="row">
        <div class="col-md-6">
            <p>Dear {{$employee->getName() ?? ''}},</p>
            You Have Been Selected As An Administrator For The Course
            <strong>{{$training->getTitle() ?? trans('labels.not_found')}}</strong>
        </div>
    </div>
</div>


</body>
</html>
