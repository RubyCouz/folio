<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'cedric');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'cedric');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'couz02072014');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '0Zl!n[(wSs&cl?x NTY!z}N;F_IuY{m00xjE_wtPl8I_U?M2+)T^aoS~@XlOc7Ze');
define('SECURE_AUTH_KEY',  'q!MydsV73s#.-M@0wV0khH!un7.)Xgs.byfwh8}E._hL~vL$o$:[825-9/e7f4dP');
define('LOGGED_IN_KEY',    'G}0od&$#9pH`&?3hafF!7<Vpww<V[f.Nd^}W`]OP2+a7VQ-]S6=T?tX%Dc5JOV39');
define('NONCE_KEY',        'Jr+,mvbh/5s(@buHXRtB/W_6vf;:j<bAmSy8Y)6]Wgx,LZ$Z1*=k0<Fn%e}<l ,[');
define('AUTH_SALT',        'Y_Fr`^-Z^L}GaE_{J303*2jg:(^n mBpF0-?QFT3CnUC9*e[<O]7!B6PS~H#9uVy');
define('SECURE_AUTH_SALT', '<E?$J1lPmV|=K`Lx5|pZ6:]v}XovXl^J/27kzov@OP$K+Fx_8g&r:5AA`W<p5nmh');
define('LOGGED_IN_SALT',   'p-CamD]0d!|z;_<BOmi55$I!-a`NWGll+^ 7 06=atUu*Jh1[-f)XxO}R!@!H83i');
define('NONCE_SALT',       'U3bc^yBvr|v=Si<lX9BBFKwI]`gz=|m,IT;;P@>q@P/$,&n&~5hms?li_BBeE{&x');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');