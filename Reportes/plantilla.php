<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<style>
	@font-face {
  		font-family: Montserrat-Bold;
  		src: url("../Libs/fonts/Montserrat/Montserrat-Bold.ttf"); 
	}
	@font-face {
  		font-family: Montserrat-Regular;
  		src: url("../Libs/fonts/Montserrat/Montserrat-Regular.ttf"); 
	}
	@font-face {
  		font-family: Montserrat-Medium;
  		src: url("../Libs/fonts/Montserrat/Montserrat-Medium.ttf"); 
	}
	*{
		font-family:Montserrat-Regular;
	}
		#mini{
			font-size:8px;
		}
	


		#cabe{
			background:#f2f1ef;
			color:black;
			font-size:18px;
		}


		#cab{
			font-family:Montserrat-Bold;
			background:white;
			text-align: center;
			color: #621132;
			width:100%;
			height:5px;
			border: 3px groove #621132;
			border-radius: 10px 0px 10px 0px;
			height:1px;
		}

		#datos {
  background-color: #FFF1D7;
  width: 100%;
  text-align: center;
  border-collapse: collapse;
}
#datos td, #datos th {
  border: 1px solid #9D2449;
  padding: 3px 2px;
}
#datos tbody td {
  font-size: 13px;
}
#datos tr:nth-child(even) {
  background: #FFA9C3;
}
#datos thead {
  background: #621132;
  border-bottom: 1px solid #FFFFFF;
}
#datos thead th {
  font-size: 19px;
  font-weight: bold;
  color: #FFFFFF;
  text-align: center;
  border-left: 1px solid #FFFFFF;
}
#datos thead th:first-child {
  border-left: none;
}

#datos tfoot {
  font-size: 13px;
  font-weight: bold;
  color: #FFFFFF;
  background: #621132;
  border-top: 1px solid #FFFFFF;
}
#datos tfoot td {
  font-size: 13px;
}
#datos tfoot .links {
  text-align: right;
}
#datos tfoot .links a{
  display: inline-block;
  background: #FFFFFF;
  color: #A40808;
  padding: 2px 8px;
  border-radius: 5px;
}
</style>
<body>
	<div id="datos">
			<table width="100%" border="1">
				<thead>
					<tr>
						<th colspan = "3"></th>
						<th>INVERSIÓN</th>
						<th>DEPRECIACION</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1208</td>
						<td colspan = "2">MAQUINARIA Y EQUIPO</td>
						<td>$ inversion</td>
						<td>$ depreciacion</td>
					</tr>
					<tr>
						<td>1212</td>
						<td colspan = "2">MOBILIARIO Y EQUIPO DE OFICINA</td>
						<td>$ inversion</td>
						<td>$ depreciacion</td>
					</tr>
					<tr>
						<td>1216</td>
						<td colspan = "2">EQUIPO DE TRANSPORTE</td>
						<td>$ inversion</td>
						<td>$ depreciacion</td>
					</tr>
					<tr>
						<td>1220</td>
						<td colspan = "2">EQUIPO DE TRANSPORTE</td>
						<td>$ inversion</td>
						<td>$ depreciacion</td>
					</tr>
					<tr>
						<td>1228</td>
						<td colspan = "2">SOFTWARE</td>
						<td>$ inversion</td>
						<td>$ depreciacion</td>
					</tr>
				</tbody>
			</table>
		</div>
</body>
</html>