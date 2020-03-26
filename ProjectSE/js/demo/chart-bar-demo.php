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
    // ค่าโดยปกติ
    var default_year  = "2020";
    var default_mount = "01"
    var default_type = "a";
    var _year = sessionStorage.getItem("getYear");
    var _mount = sessionStorage.getItem("getMount");
    var _type = sessionStorage.getItem("getType");
    var URL="";
    if( _year != null && _mount != null)
    {
      URL ="js/json/json_list.php?"+"id_year="+_year+"&id_mount="+_mount+"&id_type="+_type;
    }
    else if( _year == null && _mount != null )
    {
      URL ="js/json/json_list.php?"+"id_year="+default_year+"&id_mount="+_mount+"&id_type="+_type;
    }
    else if( _year != null && _mount == null)
    {
      URL ="js/json/json_list.php?"+"id_year="+_year+"&id_mount="+default_mount+"&id_type="+_type;
    }
    else
    {
      URL ="js/json/json_list.php?"+"id_year="+default_year+"&id_mount="+default_mount+"&id_type="+_type;
    }
    //chack link URL to read qry at js/json/json_list.php path.
    console.log("PATH is :: "+URL);
  $.get(URL,function(response){
    let groupItems = $.parseJSON(response);
    console.log(groupItems);
    var i,j,k;

    // ความยาวของเจสันแต่ละหมวด ที่ถูกแปลงเป็น js Obj.
    var LenObjALL = groupItems.ALL.length;
    var testLen = Object.keys(groupItems.ALL).length;
    var LenObjYEAR =Object.keys(groupItems.YEAR).length
    var LenObjMOUNT =Object.keys(groupItems.MOUNT).length
    var LenObjMax =Object.keys(groupItems.MAX).length
    var LenObjMin =Object.keys(groupItems.MIN).length
    // var size = Object.size(groupItems);
    // console.log(LenObjALL);
    // console.log(testLen);
    // console.log(LenObjYEAR);
    // console.log(LenObjMOUNT);
    var itemNameArr = [];
    var itemNumArr = [];
    var itemNameArrY = [];
    var itemNumArrY = [];
    var itemNameArrM = [];
    var itemNumArrM = [];
    var itemNameArrMax = [];
    var itemNumArrMax = [];
    var itemNameArrMin = [];
    var itemNumArrMin= [];
  
    if(groupItems.MOUNT[0] == null)
     {
      console.log("True");
     }
     else
      console.log("Fulse");
     for(i=0;i<testLen;i++)
     {
       itemNameArr.push(groupItems.ALL[i].name_e);
       itemNumArr.push(groupItems.ALL[i].numItem);
     }
    
     for(j=0;j<LenObjYEAR;j++)
     {
       if(LenObjYEAR < 1)
       {
         itemNameArrY.push(null);
         itemNumArrY.push(null);
         
       }
       else if (groupItems.YEAR[0] != null)
       {
        itemNameArrY.push(groupItems.YEAR[j].name_e_y);
        itemNumArrY.push(groupItems.YEAR[j].numItem_y);
       }
       else if (groupItems.YEAR[0] == null)
       {
        break;
       }
      }  
     for(k=0;k<LenObjMOUNT;k++)
     {
      if(LenObjMOUNT < 1)
      {
        itemNameArrM.push(null);
        itemNumArrM.push(null);
      }
      else if(groupItems.MOUNT[0] != null)
      {
        itemNameArrM.push(groupItems.MOUNT[k].name_e_m);
        itemNumArrM.push(groupItems.MOUNT[k].numItem_m);
      }
      else if(groupItems.MOUNT[0] == null)
      {
        break;
      }
     }
     console.log(LenObjMax);
     console.log(LenObjMin);
     // loop Max 3
     for(k=0;k<3;k++)
     {
      if(LenObjMax < 1)
      {
        itemNameArrMax.push(null);
        itemNumArrMax.push(null);
      }
      else if(groupItems.MAX[k] != null)
      {
        itemNameArrMax.push(groupItems.MAX[k].name_e_max);
        itemNumArrMax.push(groupItems.MAX[k].numItem_max);
      }
      else if(groupItems.MAX[k] == null)
      {
        break;
      }
     }
     // loop Min 3
     for(k=0;k<3;k++)
     {
      if(LenObjMin < 1)
      {
        itemNameArrMin.push(null);
        itemNumArrMin.push(null);
      }
      else if(groupItems.MIN[k] != null)
      {
        itemNameArrMin.push(groupItems.MIN[k].name_e_min);
        itemNumArrMin.push(groupItems.MIN[k].numItem_min);
      }
      else if(groupItems.MIN[k] == null)
      {
        break;
      }
     }
     console.log(itemNameArrMax);
     console.log(itemNumArrMax);
     console.log(itemNameArrMin);
     console.log(itemNumArrMin);
     for(i=0;i<LenObjMax;i++)
     {
      if(i == 0){
        itemNameArrMax[i]="1st high: "+itemNameArrMax[i];
      }
      else if( i ==1){
        itemNameArrMax[i]="2nd high: "+itemNameArrMax[i];
      }
      else if(i== 2){
        itemNameArrMax[i]="3rd high: "+itemNameArrMax[i];
      }
     }
     for(i=0;i<LenObjMin;i++)
     {
      if(i == 0){
        itemNameArrMin[i]="1st low: "+itemNameArrMin[i];
      }
      else if( i ==1){
        itemNameArrMin[i]="2nd low: "+itemNameArrMin[i];
      }
      else if(i== 2){
        itemNameArrMin[i]="3rd low: "+itemNameArrMin[i];
      }
     }


     //ex.var name = cars[0];
     var forNumArrY = [];
     var forNumArrM = [];
    //  var objShow = {
    //     name_e :itemNameArr,
    //      //ไม่ควรเป็นตัวนี้
    //  };
     
     //looping year array num
     for(i=0;i<testLen;i++)
     {
       for(j=0;j<LenObjYEAR;j++)
       {
        if(itemNameArr[i].localeCompare(itemNameArrY[j])==0)
              {
                forNumArrY[i]=itemNumArrY[j];
              }
       }
      // forNumArrY[i]=0;
     }
     //looping mount array num
     for(i=0;i<testLen;i++)
     {
       for(j=0;j<LenObjMOUNT;j++)
       {
        if(itemNameArr[i].localeCompare(itemNameArrM[j])==0)
          {
              forNumArrM[i]=itemNumArrM[j];
          }
       }
      // forNumArrM[i]=0;
     }
     //test forNumArrM forNumArrY
     console.log(forNumArrY);
     console.log(forNumArrM);
     
    //console.log(itemNameArr);
    
    // console.log(groupItems.ALL[1].name_e);
    // console.log(groupItems.YEAR.length);
    // console.log(_year);
    // console.log(_mount);
    // console.log(Array.isArray(itemNameArrY) && itemNameArrY.length);

  //}); ย้ายไปปิดท้ายโค้ดเพราะไม่รู้จักตัวแปร
//---------------------------------------
// Bar Chart Example
var ctxAll = document.getElementById("myBarChartAll");
var ctxMount = document.getElementById("myBarChartMount");
var ctxYear = document.getElementById("myBarChartYear");
var ctxHigh = document.getElementById("myBarChartHigh");
var ctxLow = document.getElementById("myBarChartLow");
var myBarChartAll = new Chart(ctxAll, {
  type: 'bar',
  data: {
       labels: itemNameArr,
      datasets: [{
      label: "จำนวน",
      backgroundColor: "#ffc107",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#ffc107",
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
          display: false,
          drawBorder: false
        },
        ticks: {
          //ลิมิตของตาราง ควรมีเท่ากับตารางคอลั่มที่มี
          maxTicksLimit: testLen
        },
        //ความหนาของกราฟแต่ละแถว
        maxBarThickness: 60,
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
          color: "rgb(232, 232, 232)",
          zeroLineColor: "rgb(232, 232, 232)",
          drawBorder: false,
          borderDash: [0],
          zeroLineBorderDash: [0]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 30,
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
var myBarChartYear = new Chart(ctxYear, {
  type: 'bar',
  data: {
       labels: itemNameArr,
      datasets: [{
      label: "จำนวน",
      backgroundColor: "#1cc88a",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#1cc88a",
      data: forNumArrY,
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
          display: false,
          drawBorder: false
        },
        ticks: {
          //ลิมิตของตาราง ควรมีเท่ากับตารางคอลั่มที่มี
          maxTicksLimit: testLen
        },
        //ความหนาของกราฟแต่ละแถว
        maxBarThickness: 45,
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
          color: "rgb(232, 232, 232)",
          zeroLineColor: "rgb(232, 232, 232)",
          drawBorder: false,
          borderDash: [0],
          zeroLineBorderDash: [0]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 30,
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
var myBarChartMount = new Chart(ctxMount, {
  type: 'bar',
  data: {
       labels: itemNameArr,
      datasets: [{
      label: "จำนวน",
      backgroundColor: "#36b9cc",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#36b9cc",
      data: forNumArrM,
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
          display: false,
          drawBorder: false
        },
        ticks: {
          //ลิมิตของตาราง ควรมีเท่ากับตารางคอลั่มที่มี
          maxTicksLimit: testLen
        },
        //ความหนาของกราฟแต่ละแถว
        maxBarThickness: 45,
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
          color: "rgb(232, 232, 232)",
          zeroLineColor: "rgb(232, 232, 232)",
          drawBorder: false,
          borderDash: [0],
          zeroLineBorderDash: [0]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 30,
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
//ค่ามากกกกกกกกกกกกกกกกกกกกกกก-ไปน้อย
var myBarChartHigh = new Chart(ctxHigh, {
  type: 'bar',
  data: {
       labels: itemNameArrMax,
      datasets: [{
      label: "จำนวน",
      backgroundColor: "#fa6f61",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#fa6f61",
      data: itemNumArrMax,
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
          display: false,
          drawBorder: false
        },
        ticks: {
          //ลิมิตของตาราง เท่ากับลำดับที่จะให้มี
          maxTicksLimit: 3
        },
        //ความหนาของกราฟแต่ละแถว
        maxBarThickness: 45,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 5,
          // จำนวนเส้นที่ไว้ใช้แบ่งความละเอียดแกน Y maxTicksLimit ยิ่งมาก ยิ่งละเอียด
          maxTicksLimit: 10,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'จำนวน ' + number_format(value) + ' ชิ้น';
          }
        },
        gridLines: {
          color: "rgb(232, 232, 232)",
          zeroLineColor: "rgb(232, 232, 232)",
          drawBorder: false,
          borderDash: [0],
          zeroLineBorderDash: [0]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 30,
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
// แสดงค่า top น้อยสุด
var myBarChartLow = new Chart(ctxLow, {
  type: 'bar',
  data: {
       labels: itemNameArrMin,
      datasets: [{
      label: "จำนวน",
      backgroundColor: "#db61fa",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#db61fa",
      data: itemNumArrMin,
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
          display: false,
          drawBorder: false
        },
        ticks: {
          //ลิมิตของตาราง top x
          maxTicksLimit: 3
        },
        //ความหนาของกราฟแต่ละแถว
        maxBarThickness: 45,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 5,
          // จำนวนเส้นที่ไว้ใช้แบ่งความละเอียดแกน Y maxTicksLimit ยิ่งมาก ยิ่งละเอียด
          maxTicksLimit: 10,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'จำนวน ' + number_format(value) + ' ชิ้น';
          }
        },
        gridLines: {
          color: "rgb(232, 232, 232)",
          zeroLineColor: "rgb(232, 232, 232)",
          drawBorder: false,
          borderDash: [0],
          zeroLineBorderDash: [0]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 30,
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
