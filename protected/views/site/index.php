<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to !!<i><?php //echo $user->username; ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>


<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

<label>scaned data</label>

<div class="input-group">
		<span class="input-group-btn">
				<button class="btn btn-default clip_btn glyphicon glyphicon-paperclip" data-clipboard-target="#qrcode_scaned_data"></button>
		</span>
		<input id="qrcode_scaned_data" type="text" class="form-control" v-model="qrcode_scaned_data" readonly>
</div><br>
<button class="btn btn-primary" v-on:click="qrcode_scan()">{{qrcode_btn}}</button><br>
<div>
		<img v-show="!qrcode_running && qrcode_scaned_data==''" id="qrcode_start" class="img-responsive" src="./img/qrcode_start.png"><br>
		<video v-show="qrcode_running" id="qrcode_camera" class="img-responsive" autoplay></video>
		<canvas v-show="!qrcode_running && qrcode_scaned_data!=''" id="qrcode_canvas" class="img-responsive"></canvas>
</div>

<script>
	qrcode_scan: function(){
            this.qrcode_video = $('#qrcode_camera')[0];
            this.qrcode_canvas = $('#qrcode_canvas')[0];

            if( this.qrcode_running ){
                this.qrcode_forcestop();
                return;
            }

            this.qrcode_running = true;
            this.qrcode_btn = 'QRスキャン停止';

            this.qrcode_timer = setTimeout(() =>{
                this.qrcode_forcestop();
            }, QRCODE_CANCEL_TIMER);

            return navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" }, audio: false })
            .then(stream =>{
                this.qrcode_scaned_data = "";
                this.qrcode_video.srcObject = stream;
                this.qrcode_draw();
            })
            .catch(error =>{
                alert(error);
            });
        },
        qrcode_draw: function(){
           console.log(this.qrcode_video.videoWidth, this.qrcode_video.videoHeight);
            if( this.qrcode_context == null ){
                if( this.qrcode_video.videoWidth == 0 || this.qrcode_video.videoHeight == 0 ){
                    if( this.qrcode_running )
                        requestAnimationFrame(this.qrcode_draw);
                    return;
                }
                this.qrcode_canvas.width = this.qrcode_video.videoWidth;
                this.qrcode_canvas.height = this.qrcode_video.videoHeight;
                this.qrcode_context = this.qrcode_canvas.getContext('2d');
            }
            this.qrcode_context.drawImage(this.qrcode_video, 0, 0, this.qrcode_canvas.width, this.qrcode_canvas.height);
            const imageData = this.qrcode_context.getImageData(0, 0, this.qrcode_canvas.width, this.qrcode_canvas.height);

            const code = jsQR(imageData.data, this.qrcode_canvas.width, this.qrcode_canvas.height);
            if( code && code.data != "" ){
                this.qrcode_scaned_data = code.data;
                console.log(code);

                this.qrcode_forcestop();

                this.qrcode_context.strokeStyle = "blue";
                this.qrcode_context.lineWidth = 3;

                var pos = code.location;
                this.qrcode_context.beginPath();
                this.qrcode_context.moveTo(pos.topLeftCorner.x, pos.topLeftCorner.y);
                this.qrcode_context.lineTo(pos.topRightCorner.x, pos.topRightCorner.y);
                this.qrcode_context.lineTo(pos.bottomRightCorner.x, pos.bottomRightCorner.y);
                this.qrcode_context.lineTo(pos.bottomLeftCorner.x, pos.bottomLeftCorner.y);
                this.qrcode_context.lineTo(pos.topLeftCorner.x, pos.topLeftCorner.y);
                this.qrcode_context.stroke();
            }else{
                if( this.qrcode_running )
                    requestAnimationFrame(this.qrcode_draw);
            }
        },
        qrcode_forcestop: function(){
            if( !this.qrcode_running )
                return;

            this.qrcode_running = false;

            if( this.qrcode_timer != null ){
                clearTimeout(this.qrcode_timer);
                this.qrcode_timer = null;
            }

            this.qrcode_video.pause();
            this.qrcode_video.srcObject = null;
            this.qrcode_btn = 'QRスキャン開始';
        },
</script>