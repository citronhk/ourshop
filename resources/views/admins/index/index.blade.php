@extends('admins.public.index')

@section('main')

<<<<<<< HEAD
<!-- BASIC TABLE -->
                   <h3 class="title1">栏目管理</h3>
							<div class="panel" >


<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="搜索">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form>


								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>First Name</th>
												<th>Last Name</th>
												<th>Username</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>Steve</td>
												<td>Jobs</td>
												<td>@steve</td>
											</tr>
											<tr>
												<td>2</td>
												<td>Simon</td>
												<td>Philips</td>
												<td>@simon</td>
											</tr>
											<tr>
												<td>3</td>
												<td>Jane</td>
												<td>Doe</td>
												<td>@jane</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BASIC TABLE -->




							<!-- BASIC TABLE -->
<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">后台首页</h3>
							<p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-download"></i></span>
										<p>
											<span class="number">1,252</span>
											<span class="title">Downloads</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-shopping-bag"></i></span>
										<p>
											<span class="number">203</span>
											<span class="title">Sales</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-eye"></i></span>
										<p>
											<span class="number">274,678</span>
											<span class="title">Visits</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-bar-chart"></i></span>
										<p>
											<span class="number">35%</span>
											<span class="title">Conversions</span>
										</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<div id="headline-chart" class="ct-chart"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="300" class="ct-chart-line" style="width: 100%; height: 300;"><g class="ct-grids"><line y1="265" y2="265" x1="50" x2="845.4000244140625" class="ct-grid ct-vertical"></line><line y1="229.28571428571428" y2="229.28571428571428" x1="50" x2="845.4000244140625" class="ct-grid ct-vertical"></line><line y1="193.57142857142856" y2="193.57142857142856" x1="50" x2="845.4000244140625" class="ct-grid ct-vertical"></line><line y1="157.85714285714286" y2="157.85714285714286" x1="50" x2="845.4000244140625" class="ct-grid ct-vertical"></line><line y1="122.14285714285714" y2="122.14285714285714" x1="50" x2="845.4000244140625" class="ct-grid ct-vertical"></line><line y1="86.42857142857142" y2="86.42857142857142" x1="50" x2="845.4000244140625" class="ct-grid ct-vertical"></line><line y1="50.71428571428572" y2="50.71428571428572" x1="50" x2="845.4000244140625" class="ct-grid ct-vertical"></line><line y1="15" y2="15" x1="50" x2="845.4000244140625" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><path d="M50,265L50,172.143L182.567,129.286L315.133,165L447.7,50.714L580.267,157.857L712.833,165L845.4,86.429L845.4,265Z" class="ct-area"></path></g><g class="ct-series ct-series-b"><path d="M50,265L50,236.429L182.567,157.857L315.133,207.857L447.7,93.571L580.267,129.286L712.833,65L845.4,22.143L845.4,265Z" class="ct-area"></path></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="50" y="270" width="132.5666707356771" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 133px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Mon</span></foreignObject><foreignObject style="overflow: visible;" x="182.5666707356771" y="270" width="132.5666707356771" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 133px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Tue</span></foreignObject><foreignObject style="overflow: visible;" x="315.1333414713542" y="270" width="132.56667073567706" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 133px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Wed</span></foreignObject><foreignObject style="overflow: visible;" x="447.70001220703125" y="270" width="132.56667073567712" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 133px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Thu</span></foreignObject><foreignObject style="overflow: visible;" x="580.2666829427084" y="270" width="132.56667073567712" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 133px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Fri</span></foreignObject><foreignObject style="overflow: visible;" x="712.8333536783855" y="270" width="132.566670735677" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 133px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Sat</span></foreignObject><foreignObject style="overflow: visible;" x="845.4000244140625" y="270" width="30" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 30px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Sun</span></foreignObject><foreignObject style="overflow: visible;" y="229.28571428571428" x="10" height="35.714285714285715" width="30"><span class="ct-label ct-vertical ct-start" style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">10</span></foreignObject><foreignObject style="overflow: visible;" y="193.57142857142856" x="10" height="35.714285714285715" width="30"><span class="ct-label ct-vertical ct-start" style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">15</span></foreignObject><foreignObject style="overflow: visible;" y="157.85714285714283" x="10" height="35.71428571428571" width="30"><span class="ct-label ct-vertical ct-start" style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">20</span></foreignObject><foreignObject style="overflow: visible;" y="122.14285714285714" x="10" height="35.71428571428572" width="30"><span class="ct-label ct-vertical ct-start" style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">25</span></foreignObject><foreignObject style="overflow: visible;" y="86.42857142857142" x="10" height="35.71428571428572" width="30"><span class="ct-label ct-vertical ct-start" style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">30</span></foreignObject><foreignObject style="overflow: visible;" y="50.71428571428572" x="10" height="35.714285714285694" width="30"><span class="ct-label ct-vertical ct-start" style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">35</span></foreignObject><foreignObject style="overflow: visible;" y="15" x="10" height="35.71428571428572" width="30"><span class="ct-label ct-vertical ct-start" style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">40</span></foreignObject><foreignObject style="overflow: visible;" y="-15" x="10" height="30" width="30"><span class="ct-label ct-vertical ct-start" style="height: 30px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">45</span></foreignObject></g></svg></div>
								</div>
								<div class="col-md-3">
									<div class="weekly-summary text-right">
										<span class="number">2,315</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span>
										<span class="info-label">Total Sales</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number">$5,758</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
										<span class="info-label">Monthly Income</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number">$65,938</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
										<span class="info-label">Total Income</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
                    <div class="copyrights">Collect from <a href="http://www.cssmoban.com/">企业网站模板</a></div>
	
				</div>
			</div>
=======
							<!-- BASIC TABLE -->
							
>>>>>>> origin/zhihao
								
							<!-- END BASIC TABLE -->

@endsection

