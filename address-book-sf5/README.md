# Exercices

## Twig / Services

### Première partie

Actuellement dans le fichier `templates/base.html.twig` on utilise un include du fichier `flash-alert.html.twig` :

```twig
{{ include('flash-alert.html.twig') }}
```

Dans un premier temps créer une extension Twig `AlertExtension` y créer une fonction Twig `alert` qui s'utilisera dans `templates/base.html.twig`
comme ceci :

```twig
{{ alert(app.session.flashbag.get('success')[0], 'success') }}
```

Le premier paramètre est la valeur à afficher dans l'alerte (la variable msg dans le code actuel)

Le 2e paramètre la classe utilisable dans Bootstrap (alert-success, alert-danger, alert-info, alert-warning) :
https://getbootstrap.com/docs/5.2/components/alerts/

### 2nde partie

Dans `AlertExtension` ajouter une fonction flashAlert qui sera appelée comme ceci :

```twig
{{ flashAlert('success') }}
```

Dans `AlertExtension` injecter un service (rechercher avec `debug:container`) qui vous donnerait accès
soit au flashBag directement, soit à la session, soit à la requête.

Grace au service injecter récupérer dans le flashBag les messages présent à la clé passé en paramètre de flashAlert
(dans l'exemple ci dessus `'success'`

Dans la fonction flashAlert boucler sur ces messages et les afficher sous forme d'alerte bootstrap.