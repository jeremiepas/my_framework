


###  database
- bases
--
-----------------------
  blogs
    --
    - id
    - name
    - description
    - dates_create
   articles
    --
    - id
    - id_users
    - nom
    - chapo
    - corps
    - dates_create

   users
    --
    - id
    - name
    - firstename
    - email
    - date
    - pseudo
    - dates_create

   commentaires
  --
    - id
    - pseudo
    - commentaires

   categories
  --
    - id
    - name
    - description


  piesjointes
  --
    - id
    - chemin
    - name
-----------------------------------
- relastion
--
-----------------
  - categories_articles
    - id_articles
    - id_categorie

  - articles_piecesjointes
    - id_articles
    - id_piecsjointes
  - blogs_users
    - id_users
    - id_blogs
    - droits
    - dates_creates

  - articles_users
    - users_droits
    - id_user
    - id_articles
