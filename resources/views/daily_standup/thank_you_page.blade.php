@extends('layouts.user_type.auth')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap"
        rel="stylesheet"/>

    <style>
 
main {
  flex: 1 0 auto;
}

h1.title,
.footer-copyright a {
    font-family: Poppins, sans-serif; 
    font-size: 5rem;
  text-transform: uppercase;
  font-weight: 900;
  /* color: #1a1a1a; */
  color:#cb0c9f;
  margin-bottom: 0px;
  margin-top: 50px;
}

/* start welcome animation */

div.welcome {
  box-shadow: 7px 7px 10px -4px #b2b2c3;
    background: white;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    height: 450px;
    align-items: center;
    display: flex;
    justify-content: center;
    flex-direction: column;
    /* margin-top: 40px; */
    border-radius: 35px;
}

.welcome .splash {
  height: 0px;
  padding: 0px;
  /* border: 130em solid #c20b8b; */
  border: 130em solid white;
  position: fixed;
  left: 50%;
  top: 100%;
  display: block;
  box-sizing: initial;
  overflow: hidden;

  border-radius: 50%;
  transform: translate(-50%, -50%);
  animation: puff 0.5s 1.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, borderRadius 0.2s 2.3s linear forwards;
}

.welcome #welcome {
  /* background: white ; */
  background: rgb(235, 8, 235) ;
  width: 56px;
  height: 56px;
  position: absolute;
  left: 50%;
  top: 50%;
  overflow: hidden;
  opacity: 0;
  transform: translate(-50%, -50%);
  border-radius: 50%;
  animation: init 0.5s 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, moveDown 1s 0.8s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards, moveUp 1s 1.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, materia 0.5s 2.7s cubic-bezier(0.86, 0, 0.07, 1) forwards, hide 2s 2.9s ease forwards;
}
   
/* moveIn */
.welcome header,
.welcome a.btn {
  opacity: 0;
  animation: moveIn 2s 3.1s ease forwards;
}

@keyframes init {
  0% {
    width: 0px;
    height: 0px;
  }
  100% {
    width: 56px;
    height: 56px;
    margin-top: 0px;
    opacity: 1;
  }
}

@keyframes puff {
  0% {
    top: 100%;
    height: 0px;
    padding: 0px;
  }
  100% {
    top: 50%;
    height: 100%;
    padding: 0px 100%;
  }
}

@keyframes borderRadius {
  0% {
    border-radius: 50%;
  }
  100% {
    border-radius: 0px;
  }
}

@keyframes moveDown {
  0% {
    top: 50%;
  }
  50% {
    top: 40%;
  }
  100% {
    top: 100%;
  }
}

@keyframes moveUp {
  0% {
    background: rgb(235, 8, 235) ;
    top: 100%;
  }
  50% {
    top: 40%;
  }
  100% {
    top: 50%;
    background:rgb(235, 8, 235) ;
  }
}

@keyframes materia {
  0% {
    background: rgb(235, 8, 235) ;
  }
  50% {
    background: rgb(235, 8, 235) ;
    top: 26px;
  }
  100% {
    background: rgb(235, 8, 235) ;
    width: 100%;
    height: 64px;
    border-radius: 0px;
    top: 26px;
  }
}

@keyframes moveIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

@keyframes hide {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
} 
.main-content__checkmark{
    line-height: 1;
    /* color: #24b663; */
    color:#cb0c9f;
    font-size: 5.75rem;
}
.flow-text{
  line-height: 1.4;
    font-size: 1.1rem;
    font-family: Poppins, sans-serif;
    /* color: #1a1a1a; */
    color:#3e485a;
    width: 72%;
    margin: 21px auto;
}
.timerbox time{
    color: #1a1a1a; 
    font-size: 0.9rem;
    font-family: Poppins, sans-serif; 
}
    </style>
</head>
<body>
    <div class="welcome">
        <span id="splash-overlay" class="splash"></span>
        <span id="welcome" class="z-depth-4"></span>
       
        <main class="valign-wrapper" style="text-align: center;">
          <span class="container grey-text text-lighten-1 ">
      
            <h1 class="title grey-text text-lighten-3">THANK YOU!</h1>
            <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
            <blockquote class="flow-text">You have submitted your daily standup for today. We will get in touch tomorrow.
              Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            </blockquote>
      
          
      
          </span>
        </main>
      
    
      
       
      
    </div>
    
    <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>

    @endsection