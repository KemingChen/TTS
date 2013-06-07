<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>
				會員資料
			</h3>
			<table class="table">
				<tbody>
					<tr>
						<td>
							<span>電子郵件</span>
						</td>
						<td><?php echo $email;?>
						</td>
					</tr>
					<tr class="success">
						<td>
							名稱
						</td>
						<td><?php echo $name;?>
						</td>
					</tr>
					<tr class="error">
						<td>
							<span>生日</span>
						</td>
						<td><?php echo $birthDate;?>
						</td>
					</tr>
					<tr class="warning">
						<td>
							<span>郵遞區號</span>
						</td>
						<td><?php echo $zipCode;?>
						</td>
					</tr>
					<tr class="info">
						<td>
							<span>地址</span>
						</td>
						<td><?php echo $address;?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>