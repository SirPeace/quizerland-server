<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::beginTransaction();
        foreach ($this->getSchema() as $quizSchema) {
            /** @var Quiz $quiz */
            $quiz = Quiz::query()->create(
                collect($quizSchema)->except('questions')->toArray()
            );

            foreach ($quizSchema['questions'] as $questionSchema) {
                /** @var Question $question */
                $question = $quiz->questions()->create(
                    collect($questionSchema)->except(['answers', 'correct_answer_id'])->toArray()
                );

                foreach ($questionSchema['answers'] as $answerSchema) {
                    $question->answers()->create($answerSchema);
                }

                $question->correctAnswer()->associate($questionSchema['correct_answer_id']);
                $question->save();
            }
        }
        DB::commit();
    }

    /**
     * Get schema in the array form
     */
    public function getSchema(): array
    {
        return [
            [
                'title' => 'Тест по географии',
                'description' => 'Геогра́фия — комплекс естественных и общественных наук, изучающих структуру, функционирование и эволюцию географической оболочки, взаимодействие и распределение в пространстве природных и природно-общественных геосистем и их компонентов',
                'author_id' => 1,
                'questions' =>
                [
                    [
                        'text' => 'Столица Великобритании?',
                        'correct_answer_id' => 2,
                        'answers' =>
                        [
                            [
                                'text' => 'Париж',
                            ],
                            [
                                'text' => 'Лондон',
                            ],
                            [
                                'text' => 'Москва',
                            ],
                            [
                                'text' => 'Токио',
                            ],
                            [
                                'text' => 'Торонто',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Столица Российской Федерации?',
                        'correct_answer_id' => 3,
                        'answers' =>
                        [
                            [
                                'text' => 'Санкт-Петербург',
                            ],
                            [
                                'text' => 'Торонто',
                            ],
                            [
                                'text' => 'Москва',
                            ],
                            [
                                'text' => 'Саратов',
                            ],
                            [
                                'text' => 'Анкара',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Тест по истории РФ',
                'description' => 'Исто́рия — наука, исследующая прошлое, реальные факты и закономерности смены исторических событий, эволюцию общества и отношений внутри него, обусловленных человеческой деятельностью на протяжении многих поколений. В наши дни появилось новое определение истории как науки «о прошлой социальной реальности»',
                'author_id' => 1,
                'questions' =>
                [
                    [
                        'text' => 'В каком году началось сражение под Сталинградом?',
                        'correct_answer_id' => 5,
                        'answers' =>
                        [
                            [
                                'text' => 'в 1943',
                            ],
                            [
                                'text' => 'в 1945',
                            ],
                            [
                                'text' => 'в 1905',
                            ],
                            [
                                'text' => 'в 1917',
                            ],
                            [
                                'text' => 'в 1942',
                            ],
                        ],
                    ],
                    [
                        'text' => 'В каком году началась Первая Мировая Война?',
                        'correct_answer_id' => 4,
                        'answers' =>
                        [
                            [
                                'text' => 'в 1812',
                            ],
                            [
                                'text' => 'в 1910',
                            ],
                            [
                                'text' => 'в 1905',
                            ],
                            [
                                'text' => 'в 1914',
                            ],
                            [
                                'text' => 'в 1939',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Тест по брендам автомобилей',
                'description' => 'Автомоби́ль — моторное безрельсовое дорожное и/или внедорожное, чаще всего автономное, транспортное средство, используемое для перевозки людей и/или грузов, имеющее от четырёх колёс. Основное назначение автомобиля заключается в совершении транспортной работы.',
                'author_id' => 1,
                'questions' =>
                [
                    [
                        'text' => 'Какая страна производит автомобили SAAB?',
                        'correct_answer_id' => 4,
                        'answers' =>
                        [
                            [
                                'text' => 'Германия',
                            ],
                            [
                                'text' => 'Италия',
                            ],
                            [
                                'text' => 'США',
                            ],
                            [
                                'text' => 'Швеция',
                            ],
                            [
                                'text' => 'Франция',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Кто запатентовал первый автомобиль на бензиновом двигателе?',
                        'correct_answer_id' => 2,
                        'answers' =>
                        [
                            [
                                'text' => 'Николас-Джозеф Кагнот',
                            ],
                            [
                                'text' => 'Фредрих Майкл Бенз',
                            ],
                            [
                                'text' => 'Иван Петрович Кулыбин',
                            ],
                            [
                                'text' => 'Генри Форд',
                            ],
                            [
                                'text' => 'Джен Джозеф Эттин Леноир',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Тест по музыке',
                'description' => 'Му́зыка — вид искусства, в котором определённым образом организованные звуки используются для создания некоторого сочетания формы, гармонии, мелодии, ритма или иного выразительного содержания',
                'author_id' => 1,
                'questions' =>
                [
                    [
                        'text' => 'В каком году вышел альбом \'The Dark Side of the Moon\' группы Pink Floyd?',
                        'correct_answer_id' => 5,
                        'answers' =>
                        [
                            [
                                'text' => '1969',
                            ],
                            [
                                'text' => '1970',
                            ],
                            [
                                'text' => '1981',
                            ],
                            [
                                'text' => '1975',
                            ],
                            [
                                'text' => '1973',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Какая первая композиция альбома Enigma?',
                        'correct_answer_id' => 2,
                        'answers' =>
                        [
                            [
                                'text' => 'The Cross of Changes',
                            ],
                            [
                                'text' => 'MCMXC a.D.',
                            ],
                            [
                                'text' => 'Seven Lives Many Faces',
                            ],
                            [
                                'text' => 'The Fall Of a Rebel Angel',
                            ],
                            [
                                'text' => 'The Screen Behind the Mirror',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Тест по изобразительному искусству',
                'description' => 'Изобрази́тельное иску́сство или изобрази́тельные иску́сства — класс пространственных искусств, объединяющий живопись, скульптуру, графику, монументальное искусство и фотоискусство.',
                'author_id' => 1,
                'questions' =>
                [
                    [
                        'text' => 'Кто нарисовал картину \'Девятый Вал\' ?',
                        'correct_answer_id' => 4,
                        'answers' =>
                        [
                            [
                                'text' => 'Василий Суриков',
                            ],
                            [
                                'text' => 'Клауд Монет',
                            ],
                            [
                                'text' => 'Сандро Боттичелли',
                            ],
                            [
                                'text' => 'Иван Айвазовский',
                            ],
                            [
                                'text' => 'Сальвадор Дали',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Самая известная картина Малевича?',
                        'correct_answer_id' => 1,
                        'answers' =>
                        [
                            [
                                'text' => 'Черный квадрат',
                            ],
                            [
                                'text' => 'Черный круг',
                            ],
                            [
                                'text' => 'Последний суд',
                            ],
                            [
                                'text' => 'Бурлаки на Волге',
                            ],
                            [
                                'text' => 'Автопортрет Малевича',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Тест о космосе',
                'description' => 'Косми́ческое простра́нство, ко́смос — относительно пустые участки Вселенной, которые лежат вне границ атмосфер небесных тел.',
                'author_id' => 1,
                'questions' =>
                [
                    [
                        'text' => 'Первый астронавт отправившийся в космос?',
                        'correct_answer_id' => 2,
                        'answers' =>
                        [
                            [
                                'text' => 'Билли Джин',
                            ],
                            [
                                'text' => 'Юрий Гагарин',
                            ],
                            [
                                'text' => 'Алексей Леонов',
                            ],
                            [
                                'text' => 'Валентина Терешкова',
                            ],
                            [
                                'text' => 'Сергей Королев',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Самая близкая планета к солнцу это ...',
                        'correct_answer_id' => 5,
                        'answers' =>
                        [
                            [
                                'text' => 'Плутон',
                            ],
                            [
                                'text' => 'Земля',
                            ],
                            [
                                'text' => 'Марс',
                            ],
                            [
                                'text' => 'Луна',
                            ],
                            [
                                'text' => 'Меркурий',
                            ],
                        ],
                    ],
                ],
            ]
        ];
    }
}
