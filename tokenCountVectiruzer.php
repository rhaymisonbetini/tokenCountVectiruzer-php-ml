<?php

require_once __DIR__ . '/vendor/autoload.php';

use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Tokenization\WhitespaceTokenizer;

$samples = ["Olá", "bom dia", 'Boa tarde', "Boa noite", "Como vai você?"];

$vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());

$vectorizer->fit($samples);

$result = $vectorizer->getVocabulary();

print_r($result);

$vectorizer2 = new TokenCountVectorizer(new WhitespaceTokenizer());

$samples2 = [["Olá, bom dia"], ['Boa tarde, tudo bem com voce?'], ["Boa noite, esta frio hoje né?"], ["Como vai você?"]];

for ($i = 0; $i < count($samples2); $i++) {

    $vectorizer2->fit($samples2[$i]);

    $result2 = $vectorizer2->getVocabulary();

    $vectorizer2->transform($result2);

    $transformer = new TfIdfTransformer($result2);

    $transformer->transform($result2);

    echo "Importancia da " . ($i + 1) . "º frase: " . $result2[0][0] . "\n";
}
