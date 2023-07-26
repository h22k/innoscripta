import Container from '../base/Container';
import FlexBox from '../base/FlexBox';
import AppSection from '../common/AppSection';
import FilterBy from '../common/FilterBy';
import PreferenceModal from '../common/PreferenceModal';
import NewsSection from './NewsSection';

export default function Content(){

  const news = [
    { 
      title: 'what an amazing news',
      content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum repellat impedit blanditiis qui fuga porro, quaerat nemo officia sunt libero magni dolorum vero ipsa doloremque? Deleniti distinctio saepe exercitationem ab!",
      url: "https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg",
      source: 'New York Times'
    },
    { 
      title: 'what an amazing news',
      content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum repellat impedit blanditiis qui fuga porro, quaerat nemo officia sunt libero magni dolorum vero ipsa doloremque? Deleniti distinctio saepe exercitationem ab!",
      url: "https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg",
      source: 'New York Times'
    },
    { 
      title: 'what an amazing news',
      content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum repellat impedit blanditiis qui fuga porro, quaerat nemo officia sunt libero magni dolorum vero ipsa doloremque? Deleniti distinctio saepe exercitationem ab!",
      url: "https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg",
      source: 'BBC'
    },
    { 
      title: 'what an amazing news',
      content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum repellat impedit blanditiis qui fuga porro, quaerat nemo officia sunt libero magni dolorum vero ipsa doloremque? Deleniti distinctio saepe exercitationem ab!",
      url: "https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg",
      source: 'BBC'
    },
    { 
      title: 'what an amazing news',
      content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum repellat impedit blanditiis qui fuga porro, quaerat nemo officia sunt libero magni dolorum vero ipsa doloremque? Deleniti distinctio saepe exercitationem ab!",
      url: "https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg",
      source: 'New York Times'
    },
    { 
      title: 'what an amazing news',
      content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum repellat impedit blanditiis qui fuga porro, quaerat nemo officia sunt libero magni dolorum vero ipsa doloremque? Deleniti distinctio saepe exercitationem ab!",
      source: 'BBC'
    }
  ]

  return(
    <AppSection>
      <FlexBox className='mb-4 flex-wrap flex-col sm:flex-row !items-start'>
        <FilterBy by='date'/>
        <FilterBy by='category'/>
        <FilterBy by='source'/>
        <PreferenceModal/>
      </FlexBox>
      <FlexBox className='w-full gap-6 flex-col lg:flex-row !items-start'>
        <NewsSection title='Most viewed news' news={news} className='basis-full lg:basis-3/5'/>
        <NewsSection mini title='Local news' news={news} className='basis-full lg:basis-2/5'/>
      </FlexBox>
    </AppSection>
  );
}