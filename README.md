Blind MongoDB credentials extraction tool
This tool extracts the password for a given user from MongoDB. Also, it could be used to extract passwords from other different NoSQL database engines.
Password has been properly sanitized for allowing to check special characters through regex avoiding false positives. 

##Usage
Set $url and target $username. Tweaking headers could be necessary to reach the form, modify them for each case. Also, the default protocol has been set to POST.

Run through php:
```php -f nosqli.php```

##Payload customization
You can tweak the payload to use different combinations. Check [PayloadsAllTheThings repo](https://github.com/swisskyrepo/PayloadsAllTheThings/tree/master/NoSQL%20Injection) for other useful payloads.

##Why PHP?
I feel more comfortable with PHP there isn't any other reason.