// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    // เราต้องดึงมาจากฐานข้อมูลในส่วนของหมวดอุปกรณ์
    // labels: ["January", "February", "March", "April", "May", "June","wow","eiei","not wow","1","2","3"],
    // datasets: [{
    //   label: "Revenue.test",
    //   backgroundColor: "#0917d9",
    //   hoverBackgroundColor: "#2e59d9",
    //   borderColor: "#0917d9",
    //   data: [17000, 5312, 6251, 7841, 9821, 14984,5555,1234,20000,1000,2000,3000],
       labels: ["หมวด:1", "หมวด:2", "หมวด:3", "หมวด:4", "หมวด:5", "หมวด:6","หมวด:7",
       "หมวด:8","หมวด:9","หมวด:10","หมวด:11","หมวด:อื่นๆ++"],
      datasets: [{
      label: "จำนวน",
      backgroundColor: "#a4eff5",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#a4eff5",
      data: [10, 5, 12, 15, 4, 0,4,7,11,20,25,27],
    }],
  
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          //รายละเอียดแกน X
          unit: 'หมวดอุปกรณ์'

        },
        gridLines: {
          display: true,
          drawBorder: false
        },
        ticks: {
          //ลิมิตของตาราง ควรมีเท่ากับตารางคอลั่มที่มี
          maxTicksLimit: 12
        },
        //ความหนาของกราฟแต่ละแถว
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 30,
          // จำนวนเส้นที่ไว้ใช้แบ่งความละเอียดแกน Y maxTicksLimit ยิ่งมาก ยิ่งละเอียด
          maxTicksLimit: 10,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'จำนวน ' + number_format(value) + ' ชิ้น';
          }
        },
        gridLines: {
          color: "rgb(245, 137, 196)",
          zeroLineColor: "rgb(245, 137, 196)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 24,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel)+' ชิ้น';
        }
      }
    },
  }
});
