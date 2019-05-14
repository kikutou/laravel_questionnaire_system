@extends('layouts.app')


@section('content')
  <div align="center">
      <h1>タイトル：{{ $questionnaire->title }}の</h1></br>
      @foreach($questions as $question)
        <h2>
          @if($question->mtb_question_type_id==1||$question->mtb_question_type_id==2||$question->mtb_question_type_id==3)
            {{ $question->number }}:{{ $question->question }}
          @endif
        </h2>
        {{-- @php dd($questionnaire->count_people_for_single() ) @endphp --}}
          @if($question->mtb_question_type_id==1||$question->mtb_question_type_id==2||$question->mtb_question_type_id==3)
              <table border="1">
                  <tr align="center">
                    <th>選択肢</th>
                    <th>人数</th>
                    <th>総人数</th>
                    <th>％</th>
                  </tr>

                  @php  $percent_for_single=[] @endphp
                  @php  $percent_for_select=[] @endphp


                  @foreach($question->choices as $index=>$choice)
                  <tr align="center">
                    <td>{{ $choice->choice }}</td>
                    <td>

                      @if($question->mtb_question_type_id==1)
                          @php $not_found = true @endphp
                              @php $answer_people_with=[] @endphp
                                  @foreach($questionnaire->count_people_for_multi() as $answer_key => $answer_people)
                                        @if($choice->id == $answer_key)
                                           @php $answer_people_with[]=$answer_people @endphp
                                           @php $not_found = false @endphp
                                        @endif
                                  @endforeach

                                  @if($not_found)
                                    @php $answer_people_with[]=0 @endphp
                                  @endif

                                  @foreach($answer_people_with as $value)
                                    {{  $value }}
                                      @php $percent_for_multi[] = sprintf("%.2f%%", $value/$questionnaire->count_max_people() * 100) @endphp
                                  @endforeach
                      @endif



                      @if($question->mtb_question_type_id==2)
                          @php $not_found = true @endphp
                              @php $answer_people_with=[] @endphp
                                  @foreach($questionnaire->count_people_for_single() as $answer_key => $answer_people)
                                        @if($choice->id == $answer_key)
                                           @php $answer_people_with[]=$answer_people @endphp
                                           @php $not_found = false @endphp
                                        @endif
                                  @endforeach

                                  @if($not_found)
                                    @php $answer_people_with[]=0 @endphp
                                  @endif

                                  @foreach($answer_people_with as $value)
                                    {{  $value }}
                                      @php $percent_for_single[] = sprintf("%.2f%%", $value/$questionnaire->count_max_people() * 100) @endphp
                                  @endforeach
                      @endif









                      @if($question->mtb_question_type_id==3)
                          @php $not_found = true @endphp
                              @php $answer_people_with=[] @endphp
                                  @foreach($questionnaire->count_people_for_select() as $answer_key => $answer_people)
                                        @if($choice->id == $answer_key)
                                           @php $answer_people_with[]=$answer_people @endphp
                                           @php $not_found = false @endphp
                                        @endif
                                  @endforeach

                                  @if($not_found)
                                    @php $answer_people_with[]=0 @endphp
                                  @endif

                                  @foreach($answer_people_with as $value)
                                    {{  $value }}
                                      @php $percent_for_select[] = sprintf("%.2f%%", $value/$questionnaire->count_max_people() * 100) @endphp
                                  @endforeach
                      @endif



                    </td>
                    <td>{{ $questionnaire->count_max_people() }}</td>

                    <td>
                        @if($question->mtb_question_type_id==1)
                            {{ $percent_for_multi[$index] }}
                        @endif

                        @if($question->mtb_question_type_id==2)
                            {{ $percent_for_single[$index] }}
                        @endif

                        @if($question->mtb_question_type_id==3)
                            {{ $percent_for_select[$index] }}
                        @endif
                    </td>

                  </tr>
                @endforeach
              </table>
          @endif
        @endforeach


    </div>
@endsection
