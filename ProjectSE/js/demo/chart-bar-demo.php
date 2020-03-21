<script>
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
//ส่วนนี้ริวจะลองทำ -------------------------

    var _year = sessionStorage.getItem("getYear");
    var _mount = sessionStorage.getItem("getMount");
    var URL ="js/json/json_list.php?"+"id_year="+_year+"&id_mount="+_mount;
    //chack link URL to read qry at js/json/json_list.php path.
    console.log(URL);
  $.get(URL,function(response){
    let groupItems = $.parseJSON(response);
    console.log(groupItems);
    var i,j,k;

    // ความยาวของเจสันแต่ละหมวด ที่ถูกแปลงเป็น js Obj.
    var LenObjALL = groupItems.ALL.length;
    var LenObjYEAR =groupItems.YEAR.length;
    var LenObjMOUNT =groupItems.MOUNT.length;

    var itemNameArr = [];
    var itemNumArr = [];
    var itemNameArrY = [];
    var itemNumArrY = [];
    var itemNameArrM = [];
    var itemNumArrM = [];



    for(i=0;i<LenObjALL;i++)
    {
      itemNameArr.push(groupItems.ALL[i].name_e);
      itemNumArr.push(groupItems.ALL[i].numItem);
    }
    for(j=0;j<LenObjYEAR;j++)
    {
      itemNameArrY.push(groupItems.YEAR[j].name_e_y);
      itemNumArrY.push(groupItems.YEAR[j].numItem_y);
    }  
    for(k=0;k<LenObjMOUNT;k++)
    {
      itemNameArrM.push(groupItems.MOUNT[k].name_e_m);
      itemNumArrM.push(groupItems.MOUNT[k].numItem_m);
    } 
    //console.log(itemNameArr);
    <?php session_start(); ?>
    console.log(groupItems.ALL[1].name_e);
    console.log(groupItems.YEAR.length);
    console.log(_year);
    console.log(_mount);

  //}); ย้ายไปปิดท้ายโค้ดเพราะไม่รู้จักตัวแปร
//---------------------------------------
// Bar Chart Example
var ctxAll = document.getElementById("myBarChartAll");
var ctxMount = document.getElementById("myBarChartMount");
var ctxYear = document.getElementById("myBarChartYear");
var myBarChartAll = new Chart(ctxAll, {
  type: 'bar',
  data: {
       labels: itemNameArr,
      datasets: [{
      label: "จำนวน",
      backgroundColor: "#3b5e8c",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#3b5e8c",
      data: itemNumArr
      ,
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
          maxTicksLimit: LenObjALL
        },
        //ความหนาของกราฟแต่ละแถว
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 10,
          // จำนวนเส้นที่ไว้ใช้แบ่งความละเอียดแกน Y maxTicksLimit ยิ่งมาก ยิ่งละเอียด
          maxTicksLimit: 10,
          
          padding: 2,
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
  

//-------- 2
var myBarChartMount = new Chart(ctxMount, {
  type: 'bar',
  data: {
       labels: itemNameArrY,
      datasets: [{
      label: "จำนวน",
      backgroundColor: "#3b5e8c",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#3b5e8c",
      data: itemNumArrY,
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
          maxTicksLimit: LenObjYEAR
        },
        //ความหนาของกราฟแต่ละแถว
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15,
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

//-------------3
var myBarChartYear = new Chart(ctxYear, {
  type: 'bar',
  data: {
       labels: itemNameArrM,
      datasets: [{
      label: "จำนวน",
      backgroundColor: "#3b5e8c",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#3b5e8c",
      data: itemNumArrM,
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
          maxTicksLimit: LenObjMOUNT
        },
        //ความหนาของกราฟแต่ละแถว
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 10,
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

  }); // ปิด GET จากริว
  </script>
