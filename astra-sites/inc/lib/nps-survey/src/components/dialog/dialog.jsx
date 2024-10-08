import { NpsRating, Comment, PluginRating } from '../steps';
import useStore from '../../store/store.js';
import { XMarkIcon } from '@heroicons/react/20/solid';
import {
	handleCloseNpsSurvey,
	handleNpsSurveyApi,
} from '../../utils/helper.js';
import { useState } from 'react';

const NpsDialog = function () {
	const { showNps, currentStep, npsRating } = useStore( ( state ) => ( {
		showNps: state.showNps,
		currentStep: state.currentStep,
		npsRating: state.npsRating,
	} ) );

	const { dispatch } = useStore();

	const [ processing, setProcessing ] = useState( false );

	if ( ! showNps ) {
		return;
	}

	const renderStep = () => {
		if ( 'nps-rating' === currentStep ) {
			return <NpsRating />;
		}

		if ( 'comment' === currentStep ) {
			return <Comment />;
		}

		if ( 'plugin-rating' === currentStep ) {
			return <PluginRating />;
		}
	};

	const closeNpsSurvey = function () {
		if ( processing ) {
			return;
		}

		if ( npsRating && currentStep === 'plugin-rating' ) {
			handleNpsSurveyApi(
				npsRating,
				'',
				'plugin-rating',
				dispatch,
				setProcessing
			);
		}

		handleCloseNpsSurvey( dispatch, currentStep );
	};

	return (
		<div className="max-w-[30rem] w-full flex bg-white shadow-nps sm:rounded-lg fixed bottom-2 right-2 z-10 p-4 sm:p-5 border border-solid border-border-tertiary">
			{ renderStep() }
			<span
				className="absolute top-3 right-3 cursor-pointer"
				onClick={ closeNpsSurvey }
			>
				<XMarkIcon
					className="h-5 w-5 text-zip-app-inactive-icon"
					aria-hidden="true"
				/>
			</span>
		</div>
	);
};

export default NpsDialog;
