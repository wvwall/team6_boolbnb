$( "#payment-form" ).on( "submit", function( e ) {
    e.preventDefault();
    $.post( "/stripe-checkout", $( this ).serialize(), function( response ) {
        stripe.confirmCardPayment(response.secret, {
            payment_method: {
                card: card
            }    
        }).then(function( result ) {
            if( result.error ) {
                // Gestione errore
            } else {
               if(result.paymentIntent.status === "succeeded") {
                  // Successo
               } else {
                  // Gestione errore 
               }
            }
        });
    });
});