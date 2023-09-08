<style type="text/css">
	.jam_analog {
		background-image: url('/assets/img/jam.png');
		background-repeat: no-repeat;
		background-size: cover;
		position: relative;
		width: 300px;
		height: 300px;
		border: 5px solid #52b6f0;
		border-radius: 50%;
		padding: 20px;
		margin: 20px auto;
	}

	.jam {
		height: 100%;
		width: 100%;
		position: relative;
	}

	.jarum {
		position: absolute;
		width: 46%;
		background: #232323;
		top: 50%;
		transform: rotate(90deg);
		transform-origin: 100%;
		transition: all 0.05s cubic-bezier(0.1, 2.7, 0.58, 1);
		left: 11px;
	}

	.lingkaran_tengah {
		width: 24px;
		height: 24px;
		background: #232323;
		border: 4px solid #52b6f0;
		position: absolute;
		top: 108px;
		left: 51%;
		margin-left: -14px;
		margin-top: -17.5px;
		border-radius: 50%;
		/* z-index: 9999; */
	}

	.jarum_detik {
		height: 2px;
		border-radius: 1px;
		background: #F0C952;
		top: 106px;
		/* z-index: 8888; */
	}

	.jarum_menit {
		height: 4px;
		border-radius: 4px;
		top: 106px;
		/* z-index: 7777; */
		background-color: salmon;
	}

	.jarum_jam {
		height: 8px;
		border-radius: 4px;
		width: 35%;
		left: 15%;
		top: 97px;
		/* z-index: 6666; */
	}
</style>



<div class="jam_analog">
	<img src="" alt="">
	<div class="jam">
		<div class="jarum jarum_detik"></div>
		<div class="jarum jarum_menit"></div>
		<div class="jarum jarum_jam"></div>
		<div class="lingkaran_tengah"></div>
	</div>
</div>




<script type="text/javascript">
	const secondHand = document.querySelector('.jarum_detik');
	const minuteHand = document.querySelector('.jarum_menit');
	const jarum_jam = document.querySelector('.jarum_jam');

	function setDate() {
		const now = new Date();

		const seconds = now.getSeconds();
		const secondsDegrees = ((seconds / 60) * 360) + 90;
		secondHand.style.transform = `rotate(${secondsDegrees}deg)`;
		if (secondsDegrees === 90) {
			secondHand.style.transition = 'none';
		} else if (secondsDegrees >= 91) {
			secondHand.style.transition = 'all 0.05s cubic-bezier(0.1, 2.7, 0.58, 1)'
		}

		const minutes = now.getMinutes();
		const minutesDegrees = ((minutes / 60) * 360) + 90;
		minuteHand.style.transform = `rotate(${minutesDegrees}deg)`;

		const hours = now.getHours();
		const hoursDegrees = ((hours / 12) * 360) + 90;
		jarum_jam.style.transform = `rotate(${hoursDegrees}deg)`;
	}


	window.setInterval(setDate, 1000)
</script>