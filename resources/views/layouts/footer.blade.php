</div>

<!--Body of Content End-->
<!--Footer Start-->
<footer>
    <div class=footerContainer>
        <div class=footlogoCol>
            <img id="footerLogo" src="{{ asset('public/images/PyLogo.JPG') }}" alt="placeholder">
        </div>
        <div class=footCol-1><br>
            <a href="placeholder">Why Python?</a>
            <br>
            <a href="placeholder">Student Area</a>
            <br>
            <a href="placeholder">Parent Area</a>
        </div>
        <div class=footCol-2><br>
            <a href="placeholder">Contact</a>
            <br>
            <a href="placeholder">FAQ</a>
            <br>
            <a href="placeholder">Help</a>
        </div>
        <div class=footCol-3><br>
            <a href="placeholder">Login</a>
            <br>
            <a href="placeholder">Signup as Student</a>
            <br>
            <a href="placeholder">Signup as Parent</a>
        </div>
        <div class=footCol-4>
            <br>
            <form>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email Address" aria-label="Email Address" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Subscribe</button>
                </div>
            </form>
            <span style="font-size:12px;">&copy; 2021 PyTeach. All Rights Reserved.</span>
        </div>
    </div>
</footer>


@if(session('success'))
<script>
swal(
    '{{session('success')}}',
    '',
    'success'
);
</script>
@endif

@if(session('error'))
<script>
    swal(
        '{{session('error')}}',
        '',
        'error'
    );
</script>
    @endif
</body>
</html>
