<body>
    <div class="container">
        <h1>Popup Login</h1>
        <a href="#" class="btn" id="btn">Login</a>
    </div>
    <div class="popup">
        <div class="popup-content">
            <img src="close.png" width="30px" alt="" class="close">
            <img src="reset-password.png" width="55px" alt="">
            <input type="text" placeholder="username">
            <input type="password" placeholder="password">
            <a href="#" class="btn">Login</a>
        </div>
    </div>
    <script>
        document.getElementById("btn").addEventListener("click", function(){
            document.querySelector(".popup").style.display = "flex";
        })
        document.querySelector(".close").addEventListener("click", function(){
            document.querySelector(".popup").style.display = "none";f
        })
    </script>
</body>