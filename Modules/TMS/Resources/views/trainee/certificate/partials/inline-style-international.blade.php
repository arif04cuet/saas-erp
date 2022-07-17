<style type="text/css">

    @font-face {
        font-family: 'SutonnyMJ';
        src: url( {{ asset('/certificates/fonts/SutonnyMJ/SutonnyOMJ.ttf') }} ) format('truetype');
    }

    @font-face {
        font-family: 'Ruposh_Bangla';
        src: url( {{ asset('/certificates/fonts/Ruposh_Bangla/Ruposh_Bangla.ttf') }} ) format('truetype');
    }

    @font-face {
        font-family: 'Ekushey_Mohua';
        src: url( {{ asset('/certificates/fonts/Ekushey_Mohua/Ekushey_Mohua-Normal.ttf') }} ) format('truetype');
    }

    @font-face {
        font-family: 'ChandrabatiOMJ';
        src: url( {{ asset('/certificates/fonts/ChandrabatiOMJ/CHANO___.ttf') }} ) format('truetype');
    }

    @media print {
        @page {
            size: landscape;
            margin: 0;
        }
    }

    body {
        background: #fff;
        color: #242529;
        padding: 0;
        margin: 0;
    }
    body {-webkit-print-color-adjust: exact;}

    b {
        font-weight: 400 !important;
    }
    img.logo {
        height: 80px;
        margin-top: 4px;
    }

    .middle {
        width: 100%;
    }
    .border-0 {
        border: none !important;
    }
    .bd-b-1 {
        border-bottom: 1px dotted #111111;
    }

    .mini-width {
        min-width: 106px;
    }

    .w-30 {
        width: 30%;
    }
    .w-280 {
        width: 280px
    }
    .w-350 {
        width: 350px
    }
    .w-400 {
        width: 400px
    }
    .w-190 {
        width: 190px
    }
    .w-140 {
        width: 140px
    }
    .float-right {
        float: right;
    }
    .text-center{
        text-align: center;
    }
    span b.bug-1{
        margin: 0 5px 0 -15px;
    }

    .certificate  {
        display: inline-block;
    }
    .bg-frame {
        position: absolute;
        width: 1140px;
    }
    .certificate .box {
        width: 100%;
        max-width: 890px;
        max-height: 864px;
        overflow: hidden;
        padding: 15px 30px 20px 30px;
        position: relative;
        margin: 140px 150px 82px 117px;
    }

    .certificate .box .top.two {
    }

    .certificate .box .top .middle img{
        width: 240px;
    }
    .certificate .box .top .middle {
        text-align: center;
    }

    .certificate .box .top .middle h3 {
        text-transform: uppercase;
        font-family: 'SutonnyMJ', serif;
        font-weight: 400;
        line-height: 0;
        margin-top: -10px;
        font-size: 24px;
        margin-bottom: 25px;
    }

    .certificate .box .top .middle h1 {
        text-transform: uppercase;
        color: #157eca;
        font-weight: 600;
        font-family: 'Ruposh_Bangla', sans-serif;
        font-size: 50px;
        line-height: 36px;
        margin-top: 25px;
    }

    .certificate .box .top.two p {
        font-size: 16px;
        padding: 0;
        margin: 35px 0 15px 0;
    }

    .certificate .box .top.two .right {
        font-family: 'SutonnyMJ', serif;
        float: right;
    }

    .certificate .box .top.two .left {
        font-family: 'SutonnyMJ', serif;
        float: left;
    }

    .certificate .box .top.two .middle {
        position: absolute;
        left: 0;
        right: 0;
    }

    .certificate .box .top.two .middle h2 {
        color: #e31820;
        font-weight: 300;
        margin: 0;
        font-family: 'Ekushey_Mohua', serif;
        font-size: 56px;
    }

    .certificate .box .body {
        margin: 95px 0 72px 0;
        font-family: 'Ruposh_Bangla', serif;
        font-size: 20px;
    }

    .certificate .box .body p {
        /*border-bottom: 1px dotted #111111;*/
        margin: 0 0 14px 0;
        line-height: 22px;
    }

    .certificate .box .body p span {
        font-family: 'ChandrabatiOMJ', serif;
        font-size: 24px;
        display: inline-block;
        margin-bottom: 0;
        background: #ffffff;
        position: relative;
        overflow: visible;
        transform: translate(0, 3px);
        padding: 0 5px 0 0;
    }

    .footer span {
        font-family: 'SutonnyMJ', serif;
        padding: 3px 15px;
        border-top: 1px solid #111111;
        font-size: 18px;
    }
</style>
