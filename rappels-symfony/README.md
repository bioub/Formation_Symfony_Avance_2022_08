# Exercices

## Rappels

En utilisant la commande `make:controller`
créer un controller `CompanyController`

En utilisant la commande `make:entity` créer une entité
`Company` avec 2 champs :

- `name` de type `string`, de longueur `80` et `NOT NULL`
- `city` de type `string`, de longueur `80` et `NULLABLE`

Lancer la commande pour générer la table (soit `doctrine:schema:update` soit avec les migrations)

Insérer 2 enregistrements minimum dans la table company sur ce modèle :

```
php bin/console doctrine:query:sql "INSERT INTO contact (first_name, last_name) VALUES('Romain', 'Bohdanowicz')"
```

Dans la méthode `index` de `CompanyController` retrouver les enregistrements pour les afficher côté Twig.