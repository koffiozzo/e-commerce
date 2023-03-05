<!doctype html5>
<html>
	
	<head>
		
        <title>Commande PDF</title>
		
	</head>
	
	<body>
		<h1>Détails Commande</h1><br>

	    Nom du Client: <h3>{{$order->name}}</h3>
	    Email du Client: <h3>{{$order->email}}</h3>
	    Téléphone du Client: <h3>{{$order->phone}}</h3>
	    Adresse du Client: <h3>{{$order->adress}}</h3>
	    ID du Client: <h3>{{$order->id}}</h3>

	    Nom du Produit: <h3>{{$order->product_title}}</h3>
        Prix du Produit: <h3>${{$order->price}}</h3>
	    Statut du Paiement: <h3>{{$order->payment_status}}</h3>
	    Id du Produit: <h3>{{$order->product_id}}</h3>
		<br><br>
        <img height="100" width="100" src="products/{{$order->Image}}">

	</body>
	
</html>