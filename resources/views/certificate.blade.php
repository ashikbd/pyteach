<h1 id="cert-title">
    Certificate of Completion
</h1>
<br><br><br><br>

<p class="smaller" id="cert-declaration">
    THIS IS TO CERTIFY THAT
</p>

<h1 id="cert-holder">
    {{$student->firstName}} {{$student->lastName}}
</h1>

<p class="smaller" id='cert-completed-line'>
    has successfully completed the
</p>

<h2 id="cert-course">
    Python Course
</h2>

<div id="cert-desc"
<p class="smaller" id='cert-details'>
    which includes foundation knowledge of computer programming using Python programming language
</p>
</div>

<br>
<p id="cert-from" class="smaller">
    &nbsp; from PyTeach
</p>

<br>
<p class="smaller" id='cert-issued'>
    <b>Issued on:</b> {{date("d M Y",strtotime($certificate->created_at))}}
</p>

<div id="cert-footer">
    <div id="cert-issued-by">

        <hr>
        <p>Issued by<br>PyTeach</p>
    </div>

</div>

<div id="cert-verify">
    Verify at {{url('view_certificate/'.$student->id)}} <br>
    Company has confirmed the participation of this individual in the course.
</div>


<style>
    @import url('https://fonts.googleapis.com/css?family=Saira+Condensed:700');

    hr {
        background-color: #be2d24;
        height: 3px;
        margin: 5px;
    }

    div#cert-footer {
        position: absolute;
        width: 60%;
        top: 645px;
        text-align: center;
    }

    #cert-stamp, #cert-ceo-sign {
        width: 60%;
        display: inline-block;
    }

    div#cert-issued-by, div#cert-ceo-design {
        width: 40%;
        display: inline-block;
        float: left;
    }

    div#cert-ceo-design {
        margin-left: 10%;
    }

    h1 {
        font-family: 'Saira Condensed', sans-serif;
        margin: 5px 0px;
    }

    body {
        width: 950px;
        height: 690px;
        position: absolute;
        left: 30px;
        top: 30px;
        border: 3px solid red;
        padding: 10px;
    }

    p {
        font-family: 'Arial', sans-serif;
        font-size: 18px;
        margin: 5px 0px;
    }

    html {
        display: inline-block;
        width: 1024px;
        height: 768px;
        border: 2px solid red;
        background: #eee url("https://i.pinimg.com/originals/b3/17/db/b317db24945589699a4ef18150dc5b73.jpg") no-repeat; background-size: 100%;
    }

    h1#cert-holder {
        font-size: 50px;
        color: #be2d24;
    }

    p.smaller {
        font-size: 17px !important;
    }

    div#cert-desc {
        width: 70%;
    }

    p#cert-from {
        color: #be2d24;
        font-family: 'Saira Condensed', sans-serif;
    }

    div#cert-verify {
        opacity: 1;
        position: absolute;
        top: 680px;
        left: 60%;
        font-size: 12px;
        color: grey;
    }
</style>
